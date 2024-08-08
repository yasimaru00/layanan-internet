<?php

namespace App\Http\Controllers;

use App\Models\PaketLayanan;
use Illuminate\Http\Request;

class PaketLayananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:paket-layanan.index')->only('index');
        $this->middleware('permission:paket-layanan.create')->only('create', 'store');
        $this->middleware('permission:paket-layanan.edit')->only('edit', 'update');
        $this->middleware('permission:paket-layanan.destroy')->only('destroy');
    }
    
    public function index(Request $request)
    {
        $data = PaketLayanan::when($request->input('nama_paket'), function ($query, $nama_paket) {
            return $query->where('nama_paket', 'like', '%' . $nama_paket . '%');
        })
        ->select('id','nama_paket', 'deskripsi', 'harga')
        ->paginate(10);
        return view('paket-layanan.index',compact('data'));
    }


    public function create()
    {
        return view('paket-layanan.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_paket' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
        ]);
        // dd($request);
        $data = PaketLayanan::create($validate);

        return redirect()->route('paket-layanan.index')->with('success','Data Berhasil ditambahkan');
    }


    public function show(string $id)
    {
        //
    }


    public function edit($id)
    {
        $data = PaketLayanan::find($id);
        return view('paket-layanan.edit',compact('data'));
    }


    public function update(Request $request, $id)
    {
        $data = PaketLayanan::findOrFail($id);
        $validate = $request->validate([
            'nama_paket' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:0',
        ]);
        // dd($request);
        $data->update([
            'nama_paket' => $request->nama_paket,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ]);

        return redirect()->route('paket-layanan.index')->with('success','Data Berhasil diubah');

    }


    public function destroy($id)
    {
        try {
            $data = PaketLayanan::findOrFail($id);
            $data->delete();
            
            return redirect()->route('paket-layanan.index')->with('success','Data Berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('paket-layanan.index')->with('error','Data saling berhubungan');

        }
    }
}
