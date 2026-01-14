@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-800">Orders</h1>
            <p class="mt-1 text-sm text-slate-500">Follow-up messages are sent automatically 10 days after the order date.</p>
        </div>
        <a href="{{ route('orders.create') }}" class="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-500">
            Add Order
        </a>
    </div>

    <div class="mt-6 overflow-x-auto rounded-lg border border-slate-200 bg-white">
        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 font-medium text-slate-600">Customer</th>
                    <th class="px-4 py-3 font-medium text-slate-600">Email</th>
                    <th class="px-4 py-3 font-medium text-slate-600">Phone</th>
                    <th class="px-4 py-3 font-medium text-slate-600">Order Date</th>
                    <th class="px-4 py-3 font-medium text-slate-600">Follow Up Sent</th>
                    <th class="px-4 py-3 font-medium text-slate-600">Notes</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($orders as $order)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="font-medium text-slate-800">{{ $order->customer_name }}</div>
                        </td>
                        <td class="px-4 py-3 text-slate-600">{{ $order->customer_email }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $order->customer_phone }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $order->order_date?->format('d M Y') }}</td>
                        <td class="px-4 py-3">
                            @if ($order->follow_up_sent_at)
                                <span class="rounded bg-emerald-100 px-2 py-1 text-xs font-semibold text-emerald-700">
                                    {{ $order->follow_up_sent_at->format('d M Y H:i') }}
                                </span>
                            @else
                                <span class="rounded bg-amber-100 px-2 py-1 text-xs font-semibold text-amber-700">
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-slate-600">{{ $order->notes }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-slate-500">
                            No orders yet. Click “Add Order” to create the first one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
@endsection
