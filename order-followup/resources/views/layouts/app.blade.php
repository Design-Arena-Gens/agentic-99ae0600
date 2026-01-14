<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Follow Up</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900">
    <div class="min-h-screen">
        <nav class="bg-white shadow">
            <div class="mx-auto max-w-5xl px-4 py-4 flex justify-between items-center">
                <a href="{{ route('orders.index') }}" class="text-xl font-semibold text-indigo-600">Order Follow Up</a>
                <a href="{{ route('orders.create') }}" class="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-500">
                    New Order
                </a>
            </div>
        </nav>

        <main class="mx-auto max-w-5xl px-4 py-8">
            @if (session('status'))
                <div class="mb-4 rounded border border-emerald-200 bg-emerald-50 p-4 text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
