<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = [
        'nama',
        'telepon',
        'alamat',
        'sales_id',
        'paket_layanan_id',
    ];
    


    public function sales()
    {
        return $this->belongsTo(Sales::class,'sales_id');
    }


    public function paket_layanan()
    {
        return $this->belongsTo(PaketLayanan::class,'paket_layanan_id');
    }
}
