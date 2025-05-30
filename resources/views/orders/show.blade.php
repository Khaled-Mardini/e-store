<x-layout  title='Order Details' heading='Order Details'>
    <div class="max-w-4xl mx-auto">

        <div class="bg-white shadow rounded p-6 space-y-4">
            <div>
                <h3 class="text-sm font-semibold text-gray-600">Order Number</h3>
                <p class="text-lg text-gray-800">{{ $order->OrderNumber }}</p>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-600">Customer</h3>
                <p class="text-lg text-gray-800">
                    {{ $order->customer->FirstName }} {{ $order->customer->LastName }}
                </p>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-600">Order Date</h3>
                <p class="text-lg text-gray-800">{{ \Carbon\Carbon::parse($order->OrderDate)->format('Y-m-d') }}</p>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-600">Total Amount (SYP)</h3>
                <p class="text-lg text-gray-800">{{ $order->TotalAmount }}</p>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-600 mb-2">Order Items</h3>
                <table class="w-full table-auto border rounded">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-2">Product</th>
                            <th class="px-4 py-2">Quantity</th>
                            <th class="px-4 py-2">Unit Price</th>
                            <th class="px-4 py-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $item->product->ProductName ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $item->Quantity }}</td>
                                <td class="px-4 py-2">{{ $item->UnitPrice }}</td>
                                <td class="px-4 py-2">{{ $item->UnitPrice * $item->Quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center mt-6">
                <div class="space-x-2 rtl:space-x-reverse">
                    <a href="{{ route('orders.edit', $order->id) }}"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Edit
                    </a>

                    <form action="{{ route('orders.destroy', ['order' => $order->id, 'page' => request('page')]) }}"
                        method="POST" class="inline-block"
                        onsubmit="return confirm('Are you sure you want to delete this order?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                </div>

                <a href="{{ route('orders.index', ['page' => request('page')]) }}"
                    class="text-indigo-600 hover:underline">← Back to orders list</a>
            </div>
        </div>
    </div>
</x-layout>
