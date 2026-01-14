@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-slate-800">Add Order</h1>
    <p class="mt-1 text-sm text-slate-500">Follow-up emails and WhatsApp messages will be sent automatically 10 days after the order date.</p>

    <form method="POST" action="{{ route('orders.store') }}" class="mt-6 space-y-6 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf

        <div>
            <label for="customer_name" class="block text-sm font-medium text-slate-700">Customer Name</label>
            <input id="customer_name" name="customer_name" type="text" value="{{ old('customer_name') }}" required
                   class="mt-1 w-full rounded border border-slate-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50">
            @error('customer_name')
                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="customer_email" class="block text-sm font-medium text-slate-700">Customer Email</label>
            <input id="customer_email" name="customer_email" type="email" value="{{ old('customer_email') }}" required
                   class="mt-1 w-full rounded border border-slate-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50">
            @error('customer_email')
                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="customer_phone" class="block text-sm font-medium text-slate-700">Customer WhatsApp Number</label>
            <input id="customer_phone" name="customer_phone" type="text" value="{{ old('customer_phone') }}" required
                   placeholder="+919876543210"
                   class="mt-1 w-full rounded border border-slate-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50">
            @error('customer_phone')
                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="order_date" class="block text-sm font-medium text-slate-700">Order Date</label>
            <input id="order_date" name="order_date" type="date" value="{{ old('order_date') }}" required
                   class="mt-1 w-full rounded border border-slate-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50">
            @error('order_date')
                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="notes" class="block text-sm font-medium text-slate-700">Notes (optional)</label>
            <textarea id="notes" name="notes" rows="4"
                      class="mt-1 w-full rounded border border-slate-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50">{{ old('notes') }}</textarea>
            @error('notes')
                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end gap-4">
            <a href="{{ route('orders.index') }}" class="text-sm text-slate-500 hover:text-slate-700">Cancel</a>
            <button type="submit" class="rounded bg-indigo-600 px-5 py-2.5 text-white hover:bg-indigo-500">
                Save Order
            </button>
        </div>
    </form>
@endsection
