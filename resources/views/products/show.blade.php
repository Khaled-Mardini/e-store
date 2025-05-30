<x-layout title='Product Details' heading='Product Details'>
    <div class="max-w-2xl mx-auto">

        <div class="bg-white shadow rounded p-6 space-y-4">
            <div>
                <h3 class="text-sm font-semibold text-gray-600">Product Name</h3>
                <p class="text-lg text-gray-800">{{ $product->ProductName }}</p>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-600">Supplier</h3>
                <p class="text-lg text-gray-800">{{ $product->supplier->CompanyName ?? 'Not assigned' }}</p>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-600">Price (SYP)</h3>
                <p class="text-lg text-gray-800">{{ $product->UnitPrice }}</p>
            </div>

            <div class="flex justify-between items-center mt-6">
                <div class="space-x-2 rtl:space-x-reverse">
                    <a href="{{ route('products.edit', $product->id) }}"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Edit
                    </a>

                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block"
                        onsubmit="return confirm('Are you sure you want to delete this product?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                </div>

                <a href="{{ route('products.index') }}" class="text-indigo-600 hover:underline">← Back to product
                    list</a>
            </div>
        </div>
    </div>
</x-layout>
