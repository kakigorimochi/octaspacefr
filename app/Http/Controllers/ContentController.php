<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ContentController extends Controller
{
    public function api(Request $request)
    {
        $result = ['status' => 0, 'result' => 'API Request failed', 'message' => 'NOTOK'];

        $key = ($request->api === 'bsc' ? 'bscscan_' : 'octaspace') .
        (isset($request->contractAddress) && $request->contractAddress !== null ? $request->contractAddress : '') . '_' . $request->address;

        if (Cache::has($key)) {
            $result = Cache::get($key) ? Cache::get($key) : $result;
            Cache::get($key) && $result['cached'] = true;
        } else {
            if ($request->api === 'bsc' && (isset($request->contractAddress) && $request->contractAddress !== null)) {
                $url = 'https://api.bscscan.com/api' .
                '?module=account' .
                '&action=tokenbalance' .
                '&contractaddress=' . $request->contractAddress .
                '&address=' . $request->address .
                '&tag=latest' .
                '&apikey=' . env('BSCSCAN_API_KEY');
            } else {
                $url = 'https://explorer.octa.space/api' .
                '?module=account' .
                '&action=balance' .
                '&address=' . $request->address;
            }
            $response = Http::get($url);

            if ($response->successful()) {
                $result = $response->json();

                Cache::put($key, $result, env('CACHE_EXPIRY_IN_SECS'));
                $result['cached'] = false;
            } else {
                return response()->json($result);
            }
        }
        return response()->json($result);
    }
}
