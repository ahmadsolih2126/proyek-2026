<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatOlahraga extends Model
{
    use HasFactory;

    protected $table = 'alat_olahragas';

    protected $fillable = [
        'nama_alat', 
        'kategori', 
        'harga', 
        'jumlah', 
        'deskripsi'
    ];
}