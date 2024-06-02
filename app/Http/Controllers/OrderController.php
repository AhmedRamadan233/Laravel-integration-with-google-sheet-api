<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessGoogleSheetsData;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;

class OrderController extends Controller
{
    public function processGoogleSheetsData()
    {
        $job = new ProcessGoogleSheetsData();
        ProcessGoogleSheetsData::dispatch($job);
        return response()->json(['message' => 'Worked now correct']);
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
        return response()->json(['orders' => $orders, 'products' => $products]);
    }




    // public function processGoogleSheetsData()
    // {
    //     $spreadsheetProductId = '14jNcQTMwAlRcx_JJpNszqovWzuBwrjKWvw4eZeotzJw';
    //     $productsSheetName = 'products!A2:D6';
    //     $products = Sheets::spreadsheet($spreadsheetProductId)
    //         ->sheet($productsSheetName)
    //         ->get();

    //     foreach ($products as $product) {
    //         Product::create([
    //             'product_name' => $product[0], 
    //             'description' => $product[1],
    //             'country' => $product[2], 
    //             'product_code' => $product[3], 
    //         ]);
    //     }

    //     $spreadsheetId = '1-ftqLjH8-rB2gNRro7uEq8j0j42oGqMvyKOw0v5__bE';
    //     $ordersSheetName = 'orders!A2:f6';
    //     $orders = Sheets::spreadsheet($spreadsheetId)
    //         ->sheet($ordersSheetName)
    //         ->get();

    //     foreach ($orders as $order) {
    //         Order::create([
    //             'client_name' => $order[0], 
    //             'phone_number' => $order[1],
    //             'final_price' => $order[2],
    //             'quantity' => $order[3], 
    //             'product_id' => $order[4], 

    //         ]);
    //     }

    //     return response()->json(['message' => 'Google Sheets data processed successfully']);
    // }

}
