<?php

namespace App\Http\Controllers;


// use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index()
    {
        return view('livewire.orders.index');

    }
    
}
