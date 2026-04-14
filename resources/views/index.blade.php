@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-10">
    <h1 class="text-3xl font-bold text-slate-800">Inventory List</h1>
    <a href="{{ route('products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition">
        + Add New Product
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase">Item Name</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase text-center">Stock</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase">Price</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($inventory as $item)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 font-medium text-gray-800">{{ $item->name }}</td>
                <td class="px-6 py-4 text-center">
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $item->stock < 5 ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
                        {{ $item->stock }}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-600">Rp {{ number_format($item->selling_price, 0, ',', '.') }}</td>
                <td class="px-6 py-4 flex justify-center space-x-3">
                    <a href="{{ route('products.edit', $item->id) }}" class="bg-amber-100 text-amber-600 px-3 py-1 rounded-md hover:bg-amber-200 transition">Edit</a>
                    <form action="{{ route('products.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus barang ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-100 text-red-600 px-3 py-1 rounded-md hover:bg-red-200 transition">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection