<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nemira Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex">
    <div class="w-64 min-h-screen bg-slate-900 text-white p-6 sticky top-0 h-screen">
        <h2 class="text-2xl font-bold mb-10 text-blue-400">Nemira<span class="text-white text-sm block">Inventory System</span></h2>
        <nav class="space-y-4">
            <a href="{{ route('products.index') }}" class="flex items-center space-x-3 py-3 px-4 rounded-xl {{ Request::is('products') || Request::is('/') ? 'bg-blue-600' : 'hover:bg-slate-800' }}">
                <span>Dashboard</span>
            </a>
            <a href="{{ route('products.create') }}" class="flex items-center space-x-3 py-3 px-4 rounded-xl {{ Request::is('products/create') ? 'bg-blue-600' : 'hover:bg-slate-800' }}">
                <span>Tambah Barang</span>
            </a>
        </nav>
    </div>

    <div class="flex-1 p-10">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
