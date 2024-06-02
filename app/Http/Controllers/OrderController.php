<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;

class OrderController extends Controller
{

    public function index()
    {
        //$spreadsheetId of orders// 14jNcQTMwAlRcx_JJpNszqovWzuBwrjKWvw4eZeotzJw
        $spreadsheetId = '1-ftqLjH8-rB2gNRro7uEq8j0j42oGqMvyKOw0v5__bE';
        $sheetName = "orders!A2:f6"; // تأكد من أن هذا هو اسم الورقة بالضبط كما هو موجود في جدول Google Sheets
        // dd($sheetName);
        // استخدم اسم الورقة فقط للحصول على بيانات الورقة بأكملها
        $sheets = Sheets::spreadsheet($spreadsheetId)
            ->sheet($sheetName)
            ->get();

        return response()->json(['sheets' => $sheets]);
    }
}
