<?php

namespace App\Http\Controllers;

use Cache;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('supplier')->paginate(perPage: 3);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Cache::remember('suppliers.all', 3600, function () {
            return Supplier::all();
        });

        return view('products.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ProductName' => 'required|string|max:255',
            'SupplierId' => 'required|exists:suppliers,id',
            'UnitPrice' => 'required|integer|min:0',
        ]);

        Cache::forget('products.all');

        Product::create($validatedData);

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $suppliers = Cache::remember('suppliers.all', 3600, function () {
            return Supplier::all();
        });

        return view('products.edit', compact('product', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'ProductName' => 'required|string',
            'SupplierId' => 'required|exists:suppliers,id',
            'UnitPrice' => 'required|integer',
        ]);

        Cache::forget('products.all');

        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Cache::forget('products.all');

        $product->IsDeleted = true;
        $product->save();

        return redirect()->route('products.index', ['page' => request('page')])
            ->with('success', 'Product deleted successfully.');
    }
}
