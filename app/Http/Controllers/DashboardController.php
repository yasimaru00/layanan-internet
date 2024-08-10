<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $chartData = $this->monthlyCustomerCount();
        
        return view('home', compact('users', 'chartData'));
    }

    private function monthlyCustomerCount()
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

        return $data->map(function ($items, $salesId) {
            return [
                'label' => $items->first()->sales->nama,
                'data' => $items->map(function ($record) {
                    return [
                        'x' => $record->year . '-' . str_pad($record->month, 2, '0', STR_PAD_LEFT),
                        'y' => $record->total
                    ];
                })->toArray(),
                'borderColor' => $this->getRandomColor(),
                'backgroundColor' => $this->getRandomColor(0.2),
                'fill' => false
            ];
        })->values();
    }

    private function getRandomColor($alpha = 1)
    {
        return sprintf('rgba(%d, %d, %d, %f)', rand(0, 255), rand(0, 255), rand(0, 255), $alpha);
    }
}
