@extends('admin-dashboard.__layoutes.master')
@section('title', 'Home Page')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Orders</li>
@endsection

@section('content')
    @livewire('orders.order-livewire')

@endsection
