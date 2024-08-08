<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketLayanan extends Model
{
    use HasFactory;

    protected $table = 'paket_layanans';
    protected $fillable = 
    [
        'nama_paket',
        'deskripsi',
        'harga',
    ];
}
