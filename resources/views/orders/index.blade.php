<x-layout title='Orders' heading='Orders List'>
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-semibold"></h2>
        <a href="{{ route('orders.create') }}"
            class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
            + New Order
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-6 py-3 text-start text-sm font-medium text-gray-500">Order #</th>
                    <th class="px-6 py-3 text-start text-sm font-medium text-gray-500">Customer</th>
                    <th class="px-6 py-3 text-start text-sm font-medium text-gray-500">Date</th>
                    <th class="px-6 py-3 text-start text-sm font-medium text-gray-500">Total (SYP)</th>
                    <th class="px-6 py-3 text-start text-sm font-medium text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($orders as $order)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $order->OrderNumber }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $order->customer->FirstName }}
                            {{ $order->customer->LastName }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ \Carbon\Carbon::parse($order->OrderDate)->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $order->TotalAmount }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 flex space-x-2 rtl:space-x-reverse">

                            <a href="{{ route('orders.show', $order->id) }}"
                                class="text-indigo-600 hover:text-indigo-800" title="View">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </a>

                            <a href="{{ route('orders.edit', $order->id) }}" class="text-blue-600 hover:text-blue-800"
                                title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>

                            <form
                                action="{{ route('orders.destroy', ['order' => $order->id, 'page' => request('page')]) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this order?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</x-layout>
