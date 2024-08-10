<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\PaketLayanan;
use App\Models\Sales;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:customer.index')->only('index');
        $this->middleware('permission:customer.create')->only('create', 'store');
        $this->middleware('permission:customer.edit')->only('edit', 'update');
        $this->middleware('permission:customer.destroy')->only('destroy');
    }


    public function index(Request $request)
    {
        // Get the currently authenticated user
        $user = auth()->user();
        
        // Get the sales record associated with the user
        $sales = $user->sales;
    
        // If the user does not have an associated sales record, return an empty result set
        if (!$sales) {
            $data = Customer::whereRaw('1 = 0')->paginate(10);
        } else {
            // Get the sales_id from the sales record
            $sales_id = $sales->id;
    
            // Get the 'nama' input from the request
            $nama = $request->input('nama');
            
            // Filter the customers by sales_id and optionally by nama
            $data = Customer::where('sales_id', $sales_id)
                ->when($nama, function ($query, $nama) {
                    return $query->where('nama', 'like', '%' . $nama . '%');
                })
                ->paginate(10);
        }
    
        return view('customer.index', compact('data', 'nama'));
    }
    


    public function create()
    {
        $paket_layanan = PaketLayanan::all();
        return view('customer.create', compact('paket_layanan'));
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        // dd($request->all());
        $validatedData = $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'sales_id' => 'required',
            'paket_layanan_id' => 'required',
        ]);


        // dd($validatedData);
        $customer = Customer::create([
            'nama' => $request->nama,   
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'sales_id' => $request->sales_id,
            'paket_layanan_id' => $request->paket_layanan_id,
        ]);

        
        return redirect()->route('customer.index')->with('success', 'Customer added successfully.');
    }
    



    public function show(string $id)
    {
        //
    }
    public function edit($id)
    {
        $data = Customer::find($id);
        return view('customer.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $data = Customer::findOrFail($id);
        $validate = $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'sales_id' => 'required',
            'paket_layanan_id' => 'required',
            'user_id' => 'required',
        ]);
        $data->update($validate);

        return redirect()->route('customer.index')->with('success', 'Data Berhasil diubah');
    }


    public function destroy($id)
    {
        try {
            $data = Customer::findOrFail($id);
            $data->delete();
            return redirect()->route('customer.index')->with('success', 'Data Berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('customer.index')->with('error', 'Data saling berhubungan');
        }
    }
}
