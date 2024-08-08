<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable =
    [
        'nama',
        'telepon',
        'alamat',
        'sales_id',
        'paket_layanan_id',
        'user_id',
    ];

    public function sales()
    {
        $this->belongsTo(Sales::class);
    }
    public function user()
    {
        $this->belongsTo(User::class);
    }
    public function paket_layanan()
    {
        $this->belongsTo(PaketLayanan::class);
    }
}
