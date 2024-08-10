<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $fillable =
    [
        'nama',
        // 'telepon',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function customer()
    {
        return $this->hasMany(Customer::class,'sales_id');
    }
}
