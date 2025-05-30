<x-layout title='Home' heading=''>
    <div class="max-w-4xl mx-auto mt-10 text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to the Order Management System</h1>
        <p class="text-gray-600 mb-8">Use the navigation bar to manage products, suppliers, and orders.</p>

        <div class="flex justify-center space-x-4">
            <a href="{{ route('products.index') }}"
               class="px-6 py-3 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                View Products
            </a>

            <a href="{{ route('orders.index') }}"
               class="px-6 py-3 bg-green-600 text-white rounded hover:bg-green-700 transition">
                View Orders
            </a>
        </div>
    </div>
</x-layout>
