<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\ServicePackage;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
        $user = auth()->user();
        
        $sales = $user->sales;
    
        if (!$sales) {
            $dataCustomers = Customer::whereRaw('1 = 0')->paginate(10);
        } else {
            $sales_id = $sales->id;
    
            $name = $request->input('name');
            
            $dataCustomers = Customer::where('sales_id', $sales_id)
                ->when($name, function ($query, $name) {
                    return $query->where('name', 'like', '%' . $name . '%');
                })
                ->paginate(10);
        }
    
        return view('customer.index', compact('dataCustomers', 'name'));
    }
    


    public function create()
    {
        $servicePackage = ServicePackage::all();
        return view('customer.create', compact('servicePackage'));
    }

    public function store(StoreCustomerRequest $request)
    {
        $validatedData = $request->validated();
        // dd($validatedData);
        $customers = Customer::create([
            'name' => $request->name,   
            'telp' => $request->telp,
            'address' => $request->address,
            'sales_id' => $request->sales_id,
            'service_package_id' => $request->service_package_id,
        ]);

        
        return redirect()->route('customer.index')->with('success', 'Customer added successfully.');
    }
    
    public function edit($customer)
    {
        $id = Crypt::decrypt($customer);
        $dataCustomers = Customer::find($id);
        $servicePackage = ServicePackage::all();
        return view('customer.edit', compact('dataCustomers','servicePackage'));
    }


    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());

        return redirect()->route('customer.index')->with('success', 'Data Berhasil diubah');
    }


    public function destroy($customer)
    {
        try {
            $id = Crypt::decrypt($customer);
            $dataCustomers = Customer::findOrFail($id);
            $dataCustomers->delete();
            return redirect()->route('customer.index')->with('success', 'Data Berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('customer.index')->with('error', 'Data saling berhubungan');
        }
    }
}
