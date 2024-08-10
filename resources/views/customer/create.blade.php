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
            <h2 class="section-title">Tambah Customer</h2>

            <div class="card">
                <div class="card-header">
                    <h4>Validasi Tambah Data</h4>
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
                            <label for="nama">Nama Customer</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon"
                                name="telepon" value="{{ old('telepon') }}">
                            @error('telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                name="alamat" value="{{ old('alamat') }}">
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="paket_layanan_id">Paket Layanan</label>
                            <select name="paket_layanan_id" id="paket_layanan_id" class="form-control select2">
                                <option value="">Pilih Paket</option>
                                @foreach ($paket_layanan as $pl)
                                    <option value="{{ $pl->id }}"
                                        {{ old('paket_layanan_id') == $pl->id ? 'selected' : '' }}>
                                        {{ $pl->nama_paket }} - {{ $pl->harga }}
                                    </option>
                                @endforeach
                            </select>
                            @error('paket_layanan_id')
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
