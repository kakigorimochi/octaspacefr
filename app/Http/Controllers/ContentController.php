<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContentController extends Controller
{
    public function bscscan(Request $request)
    {
        $result = Http::get('https://api.bscscan.com/api' .
        '?module=account' .
        '&action=tokenbalance' .
        '&contractaddress=' . $request->contractAddress .
        '&address=' . $request->address .
        '&tag=latest' .
        '&apikey=' . env('BSCSCAN_API_KEY'));

        return $result->json();
    }
}
