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
            <h2 class="section-title">Edit Service Package </h2>
            <div class="card">
                <form action="{{ route('service_package.update',$dataServicePackages ) }}" method="POST" enctype="multipart/form-data">
                    <div class="card-header">
                        <h4> Edit Data </h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Paket Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" placeholder=""
                                value="{{ old('name', isset($dataServicePackages) ? $dataServicePackages->name : '') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" placeholder=""
                                value="{{ old('description', isset($dataServicePackages) ? $dataServicePackages->description : '') }}">
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Price</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                name="price" placeholder="" value="{{ old('price', isset($dataServicePackages) ? $dataServicePackages->price : '') }}" min="0">
                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('service_package.index') }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
