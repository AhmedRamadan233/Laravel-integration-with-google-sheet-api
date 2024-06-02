@extends('admin-dashboard.__layoutes.master')
@section('title', 'Home Page')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection

@section('content')
    @livewire('products.product-livewire')
@endsection
