<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::latest()->paginate(15);

        return view('orders.index', compact('orders'));
    }

    public function create(): View
    {
        return view('orders.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:30'],
            'order_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        Order::create($validated);

        return redirect()
            ->route('orders.index')
            ->with('status', 'Order created successfully.');
    }
}
