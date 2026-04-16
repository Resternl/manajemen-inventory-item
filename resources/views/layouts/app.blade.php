<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nemira Inventory</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white antialiased">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-[#0A052E] text-white flex flex-col p-6 fixed h-full">
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-[#2563EB]">Nemira</h1>
                <p class="text-sm text-gray-400 font-semibold">Inventory system</p>
            </div>

            <nav class="flex-1 space-y-4">
                <a href="{{ route('inventory.index') }}" 
                 class="block px-4 py-3 rounded-xl font-medium transition {{ Request::is('inventory') ? 'bg-[#0055A5]' : 'hover:bg-gray-800' }}">
                 Dashbord
                </a>

                <a href="{{ route('inventory.create') }}" 
                class="block px-4 py-3 rounded-xl font-medium transition {{ Request::is('inventory/create') ? 'bg-[#0055A5]' : 'hover:bg-gray-800' }}">
                Tambah Barang
                </a>
                </nav>

            <div class="mt-auto px-6 pb-6 space-y-4">
    
                <div class="space-y-1">
                    <div class="flex justify-between items-center">
                        <span class="text-white/60 text-[10px] font-bold uppercase tracking-widest">Jumlah Item:</span>
                        <span class="text-white text-sm font-medium">{{ $titem }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-white/60 text-[10px] font-bold uppercase tracking-widest">Jumlah Stok:</span>
                        <span class="text-white text-sm font-medium">{{ $tstock }}</span>
                    </div>
                </div>

                <div class="mt-auto pt-10 border-t border-gray-800 flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-400">login ass:</p>
                                <p class="font-bold">{{ Auth::user()->name }}</p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="bg-[#FF0000] text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg">Log Out</button>
                            </form>
                        </div>
                    </div>
        </aside>

        <main class="flex-1 ml-64 p-10">
            @yield('content')
        </main>
    </div>
</body>
</html>


