@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>List Customer</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Customer</h2>

            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>List Data</h4>
                            <div class="card-header-action">
                                <a class="btn btn-icon icon-left btn-primary" href="{{ route('customer.create') }}">Add Data
                                    </a>
                                {{-- <a class="btn btn-info btn-primary active import">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    Import Data</a>
                                <a class="btn btn-info btn-primary active" href="{{ route('customer.export') }}">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                    Export Data</a>--}}
                                <a class="btn btn-info btn-primary active search">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Search Data</a> 
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="show-search mb-3" style="display: none">
                                <form id="search" method="GET" action="{{ route('customer.index') }}">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="">Customer Name</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="" value="{{ $name }}">
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                        <a class="btn btn-secondary" href="{{ route('customer.index') }}">Reset</a>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer Name</th>
                                            <th>Telephone</th>
                                            <th>Sales</th>
                                            <th>Service Package</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        @foreach ($dataCustomers as $key => $dt)
                                            <tr>
                                                <td>{{ ($dataCustomers->currentPage() - 1) * $dataCustomers->perPage() + $key + 1 }}</td>
                                                <td>{{ $dt->name }}</td>
                                                <td>{{ $dt->telp }}</td>
                                                <td>{{ $dt->sales->name }}</td>
                                                <td>{{ $dt->servicePackage->name }}</td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-end">
                                                        <a href="{{ route('customer.edit', Crypt::encrypt($dt->id)) }}"
                                                            class="btn btn-sm btn-info btn-icon "><i
                                                                class="fas fa-edit"></i>
                                                            Edit</a>
                                                        <form action="{{ route('customer.destroy', Crypt::encrypt($dt->id)) }}"
                                                            method="POST" class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $dataCustomers->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('customScript')
    <script>
        $(document).ready(function() {
            $('.import').click(function(event) {
                event.stopPropagation();
                $(".show-import").slideToggle("fast");
                $(".show-search").hide();
            });
            $('.search').click(function(event) {
                event.stopPropagation();
                $(".show-search").slideToggle("fast");
                $(".show-import").hide();
            });
            //ganti label berdasarkan nama file
            $('#file-upload').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#file-upload')[0].files[0].name;
                $(this).prev('label').text(file);
            });
        });
    </script>
@endpush

@push('customStyle')
@endpush
