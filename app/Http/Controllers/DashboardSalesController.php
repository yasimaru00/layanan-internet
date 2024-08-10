<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DashboardSalesController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('home', compact('users'));
    }

    public function sales()
    {
        $token = Session::get('api_token');
        $response = Http::withToken($token)->get(url('/api/sales/monthly-customer-count'));

        if ($response->successful()) {
            $data = $response->json();
            return view('sales.dashboard', compact('data'));
        } else {
            return redirect()->back()->withErrors('Error fetching sales data.');
        }
    }
}
