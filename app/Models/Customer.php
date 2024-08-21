<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = [
        'name',
        'telp',
        'address',
        'sales_id',
        'service_package_id',
    ];
    


    public function sales()
    {
        return $this->belongsTo(Sales::class,'sales_id');
    }


    public function servicePackage()
    {
        return $this->belongsTo(ServicePackage::class,'service_package_id');
    }
}
