<x-layout title='Edit Product' heading='Edit Product'>
    <div class="max-w-2xl mx-auto">

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc ps-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" name="ProductName" value="{{ old('ProductName', $product->ProductName) }}"
                    class="mt-1 block w-full rounded border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Supplier</label>
                <select name="SupplierId"
                    class="mt-1 block w-full rounded border-2 border-gray-300  shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Select Supplier --</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}"
                            {{ old('SupplierId', $product->SupplierId) == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->CompanyName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Price (SYP)</label>
                <input type="number" name="UnitPrice" value="{{ old('UnitPrice', $product->UnitPrice) }}"
                    class="mt-1 block w-full rounded border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    step="1" min="0">
            </div>

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <a href="{{ route('products.index') }}"
                    class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-700">Cancel</a>

                <button type="submit" class="px-4 py-2 rounded bg-indigo-600 hover:bg-indigo-700 text-white">Save
                    Changes</button>
            </div>
        </form>
    </div>
</x-layout>
