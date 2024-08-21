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
            <h2 class="section-title">Add Customer</h2>

            <div class="card">
                <div class="card-header">
                    <h4>Add Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('customer.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('post')

                        <!-- Hidden fields for sales_id and user_id -->
                        <input type="hidden" id="sales_id" name="sales_id" value="{{ auth()->user()->sales ? auth()->user()->sales->id : '' }}">
                        {{-- <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}"> --}}

                        <!-- Form fields for customer details -->
                        <div class="form-group">
                            <label for="nama">Customer Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="telepon">Telephone</label>
                            <input type="number" class="form-control @error('telp') is-invalid @enderror" id="telp"
                                name="telp" value="{{ old('telp') }}">
                            @error('telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                name="address" value="{{ old('address') }}">
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
                                        {{ old('service_package_id') == $pl->id ? 'selected' : '' }}>
                                        {{ $pl->name }} - {{ $pl->harga }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_package_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('customer.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>

                </div>
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
