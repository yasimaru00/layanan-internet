@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Edit Customer </h2>
            <div class="card">
                <form action="{{ route('customer.update', $dataCustomers) }}" method="POST" enctype="multipart/form-data">
                    <div class="card-header">
                        <h4> Edit Data Customer </h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="sales_id" name="sales_id"
                            value="{{ auth()->user()->sales ? auth()->user()->sales->id : '' }}">
                        <div class="form-group">
                            <label for="nama">Customer Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ $dataCustomers->name }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="telepon">Telephone</label>
                            <input type="number" class="form-control @error('telp') is-invalid @enderror" id="telp"
                                name="telp" value="{{ $dataCustomers->telp }}">
                            @error('telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                name="address" value="{{ $dataCustomers->address }}">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="paket_layanan_id">Service Package</label>
                            <select name="service_package_id" id="service_package_id" class="form-control select2">
                                <option value="">Choose Option</option>
                                @foreach ($servicePackage as $pl)
                                    <option value="{{ $pl->id }}"
                                        {{ $dataCustomers->service_package_id == $pl->id ? 'selected' : '' }}>
                                        {{ $pl->name }} - {{ $pl->harga }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_package_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                            <a class="btn btn-secondary" href="{{ route('customer.index') }}">Cancel</a>
                        </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('customScript')
    <script src="/assets/js/select2.min.js"></script>
@endpush

@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush

