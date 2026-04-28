@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-6 px-4">
    <div class="flex justify-between items-center mb-4 border-b border-gray-300 pb-4">
        <h1 class="text-2xl font-bold text-[#111]">Riwayat Aktifitas</h1>
        <a href="{{ route('inventory.index') }}" class="bg-[#003CBB] text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-[#003199] transition font-medium">
            ← Kembali ke Dashboard
        </a>
    </div>

    <form id="filterForm" action="{{ route('inventory.logs') }}" method="GET" class="flex flex-col lg:flex-row gap-4 mb-8">
        <div class="relative flex-grow">
            <input type="text" name="search" id="searchInput" value="{{ request('search') }}" 
                placeholder="Cari nama barang..." 
                class="w-full pl-12 pr-4 py-2 rounded-2xl border border-gray-200 focus:border-[#003CBB] outline-none font-bold shadow-sm">
            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
        </div>

        <div class="flex flex-wrap gap-3">
            <select name="user" onchange="this.form.submit()" 
                class="px-4 py-2 rounded-2xl bg-white border border-gray-200 outline-none cursor-pointer hover:bg-gray-50 min-w-[150px]">
                <option value="">Semua User</option>
                @foreach($users as $u)
                    <option value="{{ $u->username }}" {{ request('user') == $u->username ? 'selected' : '' }}>
                        {{ $u->username }}
                    </option>
                @endforeach
            </select>

            <select name="aksi" onchange="this.form.submit()" 
                class="px-4 py-2 rounded-2xl bg-white border border-gray-200 outline-none cursor-pointer hover:bg-gray-50 min-w-[175px]">
                <option value="">Semua Aktifitas</option>
                <option value="create" {{ request('aksi') == 'create' ? 'selected' : '' }}>create</option>
                <option value="update" {{ request('aksi') == 'update' ? 'selected' : '' }}>update</option>
                <option value="delete" {{ request('aksi') == 'delete' ? 'selected' : '' }}>delete</option>
            </select>

            @if(request('search') || request('user') || request('aksi'))
                <a href="{{ route('inventory.logs') }}" 
                    class="flex items-center justify-center px-4 bg-[#E50000] text-white rounded-2xl hover:bg-red-600 transition-all shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </a>
            @endif
        </div>
    </form>

    <div class="grid grid-cols-[1.2fr_2fr_1.5fr_1.2fr] gap-4 px-4 py-2 text-sm font-medium text-gray-600 uppercase tracking-wider">
        <div>Nama User</div>
        <div>Nama Barang</div>
        <div>Waktu</div>
        <div class="text-center">Aktifitas</div>
    </div>

    <div class="space-y-2">
        @forelse($logs as $log)
        <div class="grid grid-cols-[1.2fr_2fr_1.5fr_1.2fr] gap-4 items-center bg-white p-2 rounded-xl border border-gray-200 shadow-sm transition">
            <div class="px-3 py-2 text-sm font-medium border border-gray-100 rounded-lg bg-gray-50 uppercase">{{ $log->username }}</div>
            <div class="px-3 py-2 text-sm font-medium border border-gray-100 rounded-lg truncate text-gray-700">{{ $log->nama_item }}</div>
            <div class="px-3 py-2 text-[11px] border border-gray-100 rounded-lg text-gray-400 font-bold uppercase">
                {{ $log->created_at->setTimezone('Asia/Makassar')->translatedFormat('d M Y, H:i') }}
            </div>
            
            <div class="flex gap-2 justify-center px-2">
                @php
                    $aksi = strtolower($log->action);
                    $colorClass = 'bg-blue-100 text-blue-600';
                    
                    if($aksi == 'update') {
                        $colorClass = 'bg-green-100 text-green-600';
                    } elseif($aksi == 'delete') {
                        $colorClass = 'bg-red-100 text-red-600';
                    }
                @endphp
                <span class="{{ $colorClass }} text-[10px] font-black py-2 rounded-lg uppercase border border-current flex-1 text-center">
                    {{ $log->action }}
                </span>

                @if($log->details)
                <button onclick="openModal('{{ $log->nama_item }}', '{{ $log->details }}')" 
                    class="bg-[#003CBB] text-white text-[10px] font-bold px-3 py-2 rounded-lg hover:bg-blue-800 transition">
                    SHOW
                </button>
                @endif
            </div>
        </div>
        @empty
        <div class="text-center py-10 text-gray-400 border-2 border-dashed border-gray-200 rounded-2xl">
            Tidak ada riwayat aktifitas ditemukan.
        </div>
        @endforelse
    </div>
</div>

<div id="detailModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white border-black rounded-2xl w-full max-w-md overflow-hidden">
        <div class="p-6">
            <h2 class="text-xl font-bold uppercase mb-1">Detail Perubahan</h2>
            <p id="modalItemName" class="text-xs font-bold text-blue-600 uppercase mb-4"></p>
            
            <div class="bg-gray-50 border border-gray-200 p-4 rounded-xl text-sm text-gray-700 font-medium leading-relaxed mb-6">
                <p id="modalContent"></p>
            </div>

            <button onclick="closeModal()" class="w-full bg-red-600 text-white font-medium py-3 rounded-xl border-black active:shadow-none active:translate-x-1 active:translate-y-1 transition-all uppercase text-sm">
                Tutup Detail
            </button>
        </div>
    </div>
</div>

<script>
    let timeout = null;
    const form = document.getElementById('filterForm');
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('keyup', function () {
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            form.submit();
        }, 500);
    });

    function openModal(item, detail) {
        document.getElementById('modalItemName').innerText = item;
        document.getElementById('modalContent').innerText = detail;
        document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }
</script>
@endsection