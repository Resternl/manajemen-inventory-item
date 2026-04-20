<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\riwayat;


class aktivitas extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $query = riwayat::query();

    if ($request->filled('search')) {
        $query->where('nama_item', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('user')) {
        $query->where('username', $request->user);
    }

    if ($request->filled('aksi')) {
        $query->where('action', 'like', '%' . $request->aksi . '%');
    }

    $logs = $query->latest()->get();
    $users = riwayat::select('username')->distinct()->get();
    
    return view('logs', compact('logs', 'users'));
}
}
