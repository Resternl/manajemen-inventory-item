<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\item;
use App\Models\riwayat;


class inven extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
public function index(Request $request) // Tambahin Request $request di sini
{
    // 1. Ambil inputan dari user (Search, Sort, dan Filter Jenis)
    $search = $request->get('search');
    $sort = $request->get('sort', 'latest');
    $filter_jenis = $request->get('jenis');

    $query = item::query();

    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('nama_item', 'LIKE', "%{$search}%")
              ->orWhere('kode_item', 'LIKE', "%{$search}%");
        });
    }

    if ($filter_jenis) {
        $query->where('jenis_item', $filter_jenis);
    }

    if ($sort == 'stok_sedikit') {
        $query->orderBy('jumlah_item', 'asc');
    } elseif ($sort == 'stok_banyak') {
        $query->orderBy('jumlah_item', 'desc');
    } elseif ($sort == 'a_z') {
        $query->orderBy('nama_item', 'asc');
    } else {
        $query->orderBy('created_at', 'desc'); 
    }

    $inventory = $query->get();
    
    $categories = item::select('jenis_item')->distinct()->pluck('jenis_item');
    return view('index', compact('inventory', 'categories'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'nama_item' => 'required',
            'kode_item' => 'required|unique:inventory',
            'deskripsi' => 'nullable',
            'jenis_item' => 'required',
            'jumlah_item' => 'required|integer',
        ]);

        item::create($request->all());
        riwayat::record('create', $request->nama_item);
        return redirect()->route('inventory.index')->with('success', 'Item berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = item::findOrFail($id);
        return view('show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = item::findOrFail($id);
        return view ('form', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, string $id)
{
    $item = item::findOrFail($id);
    
    $request->validate([
        'nama_item' => 'required',
        'kode_item' => 'required|unique:inventory,kode_item,' . $item->id,
        'deskripsi' => 'nullable',
        'jenis_item' => 'required',
        'jumlah_item' => 'required|integer',
    ]);

    $oldData = $item->getOriginal(); 
    $item->update($request->all());
    $changes = [];
    $fields = ['nama_item', 'kode_item', 'jenis_item', 'jumlah_item'];

    foreach ($fields as $field) {
        if ($item->wasChanged($field)) {
            $oldVal = $oldData[$field];
            $newVal = $item->$field;
            $label = str_replace('_item', '', $field);
            $changes[] = "$label: $oldVal ⮕ $newVal";
        }
    }
    if (count($changes) > 0) {
        $detailText = implode(', ', $changes);
        riwayat::record('Update', $item->nama_item, $detailText);
    }

    return redirect()->route('inventory.index')->with('success', 'Item berhasil diperbarui');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = item::findOrFail($id);
        riwayat::record('delete', $item->nama_item);
        $item->delete();
        return redirect()->route('inventory.index')->with('success', 'Item berhasil dihapus');
    }

}
