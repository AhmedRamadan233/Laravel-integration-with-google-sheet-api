<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessGoogleSheetsData;
use App\Models\Order;
use App\Models\Product;
use Revolution\Google\Sheets\Facades\Sheets;
class ProcessGoogleSheetsDataController extends Controller
{
    public function processGoogleSheetsData()
    {
        $job = new ProcessGoogleSheetsData();
        ProcessGoogleSheetsData::dispatch($job);
        return redirect()->route('dashboard')->with('success', 'Job Worked Now Correct!!');

    }

    public function index()
    {
        $spreadsheetId = '1-ftqLjH8-rB2gNRro7uEq8j0j42oGqMvyKOw0v5__bE';
        $spreadsheetProductId = '14jNcQTMwAlRcx_JJpNszqovWzuBwrjKWvw4eZeotzJw';
        $ordersSheetName = 'orders!A2:f6';

        $productsSheetName = 'products!A2:D6';
        $orders = Sheets::spreadsheet($spreadsheetId)
            ->sheet($ordersSheetName)
            ->get();

        $products = Sheets::spreadsheet($spreadsheetProductId)
            ->sheet($productsSheetName)
            ->get();

        return view('admin-dashboard.home.index' , compact('products' , 'orders'));
        // return response()->json(['orders' => $orders, 'products' => $products]);
    }

}
