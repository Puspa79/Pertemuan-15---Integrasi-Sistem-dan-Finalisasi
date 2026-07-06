<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit karena nama tabelnya tunggal ('kategori')
    protected $table = 'kategori'; 

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'icon',
        'warna'
    ];
}