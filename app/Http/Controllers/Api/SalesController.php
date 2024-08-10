<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function monthlyCustomerCount()
    {
        $data = Customer::select(
                'sales_id',
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('sales_id', 'month', 'year')
            ->with('sales') 
            ->get()
            ->groupBy('sales_id');

        return response()->json($data);
    }
    
}
