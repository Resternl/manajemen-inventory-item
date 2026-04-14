<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\item;

class inven extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventory = item::all();
        return view('index', compact('inventory'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $item->update($request->all());
        return redirect()->route('inventory.index')->with('success', 'Item berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = item::findOrFail($id);
        $item->delete();
        return redirect()->route('inventory.index')->with('success', 'Item berhasil dihapus');
    }

}
