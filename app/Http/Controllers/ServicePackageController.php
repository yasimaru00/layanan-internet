<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServicePackageRequest;
use App\Http\Requests\UpdateServicePackageRequest;
use App\Models\ServicePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ServicePackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:service-package.index')->only('index');
        $this->middleware('permission:service-package.create')->only('create', 'store');
        $this->middleware('permission:service-package.edit')->only('edit', 'update');
        $this->middleware('permission:service-package.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $servicePackages = ServicePackage::when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
            ->select('id', 'name', 'description', 'price')
            ->paginate(10);
        return view('service-package.index', compact('servicePackages'));
    }


    public function create()
    {
        return view('service-package.create');
    }

    public function store(StoreServicePackageRequest $request)
    {
        $validatedData = $request->validated();
        $servicePackages = ServicePackage::create($validatedData);

        return redirect()->route('service-package.index')->with('success', 'Data Berhasil ditambahkan');
    }

    public function edit($service_package)
    {
        $id = Crypt::decrypt($service_package);
        $dataServicePackages = ServicePackage::find($id);
        return view('service-package.edit', compact('dataServicePackages'));
    }


    public function update(UpdateServicePackageRequest $request,  ServicePackage $service_package)
    {
        $service_package->update($request->all());
        return redirect()->route('service_package.index')->with('success', 'Data Berhasil diubah');
    }


    public function destroy($service_package)
    {
        try {
            $id = Crypt::decrypt($service_package);
            $servicePackages = ServicePackage::findOrFail($id);
            $servicePackages->delete();

            return redirect()->route('service_package.index')->with('success', 'Data Berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('service_package.index')->with('error', 'Data saling berhubungan');
        }
    }
}
