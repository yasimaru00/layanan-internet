<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:sales.index')->only('index');
        $this->middleware('permission:sales.create')->only('create', 'store');
        $this->middleware('permission:sales.edit')->only('edit', 'update');
        $this->middleware('permission:sales.destroy')->only('destroy');
    }


    public function index(Request $request)
    {
        $data = Sales::when($request->input('nama'), function ($query, $nama) {
            return $query->where('nama', 'like', '%' . $nama . '%');
        })
        ->paginate(10);
        return view('sales.index',compact('data'));
    }


    // public function create()
    // {
    //     $paket_layanan = PaketLayanan::all();
    //     return view('sales.create',compact('paket_layanan'));
    // }

    // public function store(Request $request)
    // {
    //     $validate = $request->validate([
    //         'nama' => 'required',
    //         'telepon' => 'required',
    //         'alamat' => 'required',
    //         'sales_id' => 'required',
    //         'paket_layanan_id' => 'required',
    //         'user_id' => 'required',
    //     ]);
    //     // dd($request);
    //     $data = Customer::create($validate);

    //     return redirect()->route('sales.index')->with('success','Data Berhasil ditambahkan');
    // }


    // public function show(string $id)
    // {
    //     //
    // }
    // public function edit($id)
    // {
    //     $data = Customer::find($id);
    //     return view('sales.edit',compact('data'));
    // }


    // public function update(Request $request, $id)
    // {
    //     $data = Customer::findOrFail($id);
    //     $validate = $request->validate([
    //         'nama' => 'required',
    //         'telepon' => 'required',
    //         'alamat' => 'required',
    //         'sales_id' => 'required',
    //         'paket_layanan_id' => 'required',
    //         'user_id' => 'required',
    //     ]);
    //     $data->update($validate);

    //     return redirect()->route('sales.index')->with('success','Data Berhasil diubah');

    // }


    // public function destroy($id)
    // {
    //     try {
    //         $data = Customer::findOrFail($id);
    //         $data->delete();
    //         return redirect()->route('sales.index')->with('success','Data Berhasil dihapus');
    //     } catch (\Exception $e) {
    //         return redirect()->route('sales.index')->with('error','Data saling berhubungan');

    //     }
    // }
}
