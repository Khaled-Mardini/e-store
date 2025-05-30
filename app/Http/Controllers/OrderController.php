<?php

namespace App\Http\Controllers;

use Cache;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('customer')->paginate(3);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Cache::remember('customers.all', 3600, function () {
            return Customer::all();
        });

        $products = Cache::remember('products.all', 3600, function () {
            return Product::all();
        });

        return view('orders.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'CustomerId' => 'required|exists:customers,id',
            'OrderDate' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.ProductId' => 'required|exists:products,id',
            'items.*.Quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $totalAmount = 0;
            $orderItems = [];

            foreach ($validated['items'] as $item) {
                $product = Product::findOrFail($item['ProductId']);
                $price = $product->UnitPrice;
                $quantity = $item['Quantity'];

                $totalAmount += $price * $quantity;

                $orderItems[] = [
                    'ProductId' => $product->id,
                    'Quantity' => $quantity,
                    'UnitPrice' => $price,
                ];
            }

            $order = Order::create([
                'CustomerId' => $validated['CustomerId'],
                'OrderDate' => $validated['OrderDate'],
                'OrderNumber' => Order::max('OrderNumber') + 1,
                'TotalAmount' => $totalAmount,
            ]);

            foreach ($orderItems as $item) {
                $order->items()->create($item);
            }

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Order created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Something went wrong while creating the order.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['customer', 'items.product']);

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $order->load(['items', 'customer']);

        $customers = Cache::remember('customers.all', 3600, function () {
            return Customer::all();
        });

        $products = Cache::remember('products.all', 3600, function () {
            return Product::all();
        });

        return view('orders.edit', compact('order', 'customers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'CustomerId' => 'required|exists:customers,id',
            'OrderDate' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.ProductId' => 'required|exists:products,id',
            'items.*.Quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $totalAmount = 0;
            $orderItems = [];

            foreach ($validated['items'] as $item) {
                $product = Product::findOrFail($item['ProductId']);
                $price = $product->UnitPrice;
                $quantity = $item['Quantity'];

                $totalAmount += $price * $quantity;

                $orderItems[] = [
                    'ProductId' => $product->id,
                    'Quantity' => $quantity,
                    'UnitPrice' => $price,
                ];
            }

            $order->update([
                'CustomerId' => $validated['CustomerId'],
                'OrderDate' => $validated['OrderDate'],
                'TotalAmount' => $totalAmount,
            ]);

            $order->items()->delete();

            foreach ($orderItems as $item) {
                $order->items()->create($item);
            }

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Something went wrong while updating the order.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        foreach ($order->items as $item) {
            $item->IsDeleted = true;
            $item->save();
        }

        $order->IsDeleted = true;
        $order->save();

        return redirect()->route('orders.index', ['page' => request('page')])
            ->with('success', 'Order deleted successfully.');
    }
}
