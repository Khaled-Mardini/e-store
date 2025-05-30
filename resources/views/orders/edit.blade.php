<x-layout  title='Edit Order' heading='Edit Order'>
    <div class="max-w-4xl mx-auto">

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc ps-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Customer</label>
                <select name="CustomerId" class="mt-1 block w-full border-2 border-gray-300 rounded shadow-sm">
                    <option value="">-- Select Customer --</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $order->CustomerId == $customer->id ? 'selected' : '' }}>
                            {{ $customer->FirstName }} {{ $customer->LastName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Order Date</label>
                <input type="date" name="OrderDate" value="{{ $order->OrderDate }}"
                    class="mt-1 block w-full border border-gray-300 rounded shadow-sm" >
            </div>

            <h3 class="text-lg font-semibold mb-2">Order Items</h3>
            <div id="order-items">
                @foreach ($order->items as $index => $item)
                    <div class="flex space-x-2 mb-2 items-center order-item">
                        <select name="items[{{ $index }}][ProductId]"
                            class="w-1/3 border-2 border-gray-300 rounded product-select">
                            <option value="">-- Select Product --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->UnitPrice }}"
                                    {{ $item->ProductId == $product->id ? 'selected' : '' }}>
                                    {{ $product->ProductName }} ({{ $product->UnitPrice }} SYP)
                                </option>
                            @endforeach
                        </select>

                        <input type="number" name="items[{{ $index }}][Quantity]"
                            value="{{ $item->Quantity }}" class="w-1/4 border border-gray-300 rounded quantity-input"
                            min="1">

                        <input type="text"
                            class="w-1/4 border border-gray-200 rounded bg-gray-100 text-gray-700 subtotal" readonly
                            placeholder="Subtotal">

                        <button type="button" onclick="removeRow(this)"
                            class="text-red-500 hover:text-red-700">Remove</button>
                    </div>
                @endforeach
            </div>

            <button type="button" onclick="addRow()" class="mb-4 text-sm text-indigo-600 hover:underline">+ Add
                Item</button>

            <div class="text-right text-lg font-semibold text-gray-700 mt-4">
                Total: <span id="total-amount">0</span> SYP
            </div>
            <br>
            <div class="flex justify-end space-x-2 mt-4">
                <a href="{{ route('orders.index') }}"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-gray-700">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 rounded text-white hover:bg-indigo-700">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <script>
        let itemIndex = {{ $order->items->count() }};
        const products = @json($products);

        function addRow() {
            const container = document.createElement('div');
            container.className = "flex space-x-2 mb-2 items-center order-item";

            container.innerHTML = `
                <select name="items[${itemIndex}][ProductId]" class="w-1/3 border-gray-300 rounded product-select">
                    <option value="">-- Select Product --</option>
                    ${products.map(p => `<option value="${p.id}" data-price="${p.UnitPrice}">${p.ProductName} (${p.UnitPrice} SYP)</option>`).join('')}
                </select>

                <input type="number" name="items[${itemIndex}][Quantity]" value="1"
                       class="w-1/4 border-gray-300 rounded quantity-input" min="1" >

                <input type="text" class="w-1/4 border border-gray-200 rounded bg-gray-100 text-gray-700 subtotal" readonly placeholder="Subtotal">

                <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700">Remove</button>
            `;

            document.getElementById('order-items').appendChild(container);
            itemIndex++;

            attachListeners();
            calculateTotal();
        }

        function removeRow(button) {
            button.parentElement.remove();
            calculateTotal();
        }

        function attachListeners() {
            const rows = document.querySelectorAll('.order-item');
            rows.forEach(row => {
                const select = row.querySelector('.product-select');
                const quantity = row.querySelector('.quantity-input');
                const subtotal = row.querySelector('.subtotal');

                const updateSubtotal = () => {
                    const price = parseFloat(select.selectedOptions[0]?.dataset.price || 0);
                    const qty = parseInt(quantity.value || 0);
                    subtotal.value = (price * qty);
                    calculateTotal();
                };

                select.onchange = updateSubtotal;
                quantity.oninput = updateSubtotal;

                updateSubtotal();
            });
        }

        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.subtotal').forEach(input => {
                total += parseFloat(input.value || 0);
            });
            document.getElementById('total-amount').textContent = total;
        }

        document.addEventListener('DOMContentLoaded', () => {
            attachListeners();
            calculateTotal();
        });
    </script>
</x-layout>
