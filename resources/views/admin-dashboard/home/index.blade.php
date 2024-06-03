@extends('admin-dashboard.__layoutes.master')
@section('title', 'Home Page')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Home</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-header p-2">
                        <form action="{{ route('process-google-sheets-data') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-block big-button shadow">
                                Now Take Data From Google Sheet To Insert It Into Database
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        Products From Google Sheet
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Description</th>
                                                        <th>Country</th>
                                                        <th>Product Code</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($products)
                                                        @foreach ($products as $product)
                                                            <tr>
                                                                <td>{{ $product[0] }}</td>
                                                                <td>{{ $product[1] }}</td>
                                                                <td>{{ $product[2] }}</td>
                                                                <td>{{ $product[3] }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="4" align="center">No Products Found.</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-md-6 -->
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        Orders From Google Sheet
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Client Name</th>
                                                        <th>Phone Number</th>
                                                        <th>Final Price</th>
                                                        <th>Quantity</th>
                                                        <th>Product ID</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($orders)
                                                        @foreach ($orders as $order)
                                                            <tr>
                                                                <td>{{ $order[0] }}</td>
                                                                <td>{{ $order[1] }}</td>
                                                                <td>{{ $order[2] }}</td>
                                                                <td>{{ $order[3] }}</td>
                                                                <td>{{ $order[4] }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="5" align="center">No Orders Found.</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
@endsection
