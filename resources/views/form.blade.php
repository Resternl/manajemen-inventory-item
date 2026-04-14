@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-4">
    <a href="{{ route('inventory.index') }}" class="inline-flex items-center gap-2 bg-[#003CBB] text-white px-4 py-2 rounded-lg shadow-sm hover:bg-[#003199] transition mb-6 text-sm font-medium">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        Back To List
    </a>

    <h1 class="text-3xl font-bold text-slate-900 mb-8">Add New Product</h1>

    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
        
        <form action="{{ isset($item) ? route('inventory.update', $item->id) : route('inventory.store') }}" method="POST">
            @csrf
            @if(isset($item)) @method('PUT') @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-10 gap-y-6">
                
                <div class="space-y-5">
                    <div>
                        <label for="nama_item" class="block text-lg font-semibold text-slate-800 mb-2">nama produk</label>
                        <input type="text" id="nama_item" name="nama_item" value="{{ old('nama_item', $item->nama_item ?? '') }}" class="w-full p-3 text-base border border-gray-200 rounded-xl outline-none focus:border-[#003CBB] transition shadow-sm" required>
                    </div>

                    <div>
                        <label for="kode_item" class="block text-lg font-semibold text-slate-800 mb-2">Kode barang</label>
                        <input type="text" id="kode_item" name="kode_item" value="{{ old('kode_item', $item->kode_item ?? '') }}" class="w-full p-3 text-base border border-gray-200 rounded-xl outline-none focus:border-[#003CBB] transition shadow-sm" required>
                    </div>

                    <div>
                        <label for="jenis_item" class="block text-lg font-semibold text-slate-800 mb-2">jenis barang</label>
                        <input type="text" id="jenis_item" name="jenis_item" value="{{ old('jenis_item', $item->jenis_item ?? '') }}" class="w-full p-3 text-base border border-gray-200 rounded-xl outline-none focus:border-[#003CBB] transition shadow-sm" required>
                    </div>

                    <div>
                        <label for="jumlah_item" class="block text-lg font-semibold text-slate-800 mb-2">Jumlah Barang</label>
                        <input type="number" id="jumlah_item" name="jumlah_item" value="{{ old('jumlah_item', $item->jumlah_item ?? '') }}" class="w-full p-3 text-base border border-gray-200 rounded-xl outline-none focus:border-[#003CBB] transition shadow-sm" required>
                    </div>
                </div>

                <div class="flex flex-col">
                    <label for="deskripsi" class="block text-lg font-semibold text-slate-800 mb-2">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="w-full p-4 text-base border border-gray-200 rounded-xl outline-none focus:border-[#003CBB] transition shadow-sm flex-grow min-h-[300px]" required>{{ old('deskripsi', $item->deskripsi ?? '') }}</textarea>
                </div>
            </div>

            <div class="mt-8 text-right">
                <button type="submit" class="bg-[#050A18] text-white px-8 py-3 rounded-xl text-lg font-bold hover:bg-slate-800 transition shadow-md">
                    Simpan Barang
                </button>
            </div>

        </form>
    </div>
</div>
@endsection