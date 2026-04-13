<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    protected $table = 'inventory';
    protected $fillable = ['nama_item', 'kode_item', 'deskripsi', 'jenis_item', 'jumlah_item'];
}
