<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class riwayat extends Model
{
    protected $table = 'riwayat';
    protected $fillable = ['username', 'action', 'nama_item', 'details'];

    public static function record($action, $itemName, $details = null)
    {
        self::create([
            'username' => Auth::user()->name ?? 'System',
            'action' => $action,
            'nama_item' => $itemName,
            'details' => $details,
        ]);
    }

}   