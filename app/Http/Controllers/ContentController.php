<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Libraries\SharedFunctions;

class ContentController extends Controller
{
    public function upd_content(Request $request)
    {
        $rs = SharedFunctions::default_msg();
        $this->validate($request, [
            'balance_octa' => 'required',
            'balance_usdt' => 'required',
            'updated_at' => 'required'
        ]);

        $content = Content::find($request->id);
        $content->balance_octa = $request->balance_octa;
        $content->balance_usdt = $request->balance_usdt;
        $content->updated_at = $request->updated_at;

        if ($content->save()) $rs = SharedFunctions::success_msg("Content updated.");

        return response()->json($rs);
    }

    public function get_bscscanapi(Request $request)
    {
        $api = Content::select('bscscan_api')->first();
        $url = 'https://api.bscscan.com/api' .
            '?module=account' .
            '&action=tokenbalance' .
            '&contractaddress=' . $request->contractAddress .
            '&address=' . $request->address .
            '&tag=latest' .
            '&apikey=' . $api->bscscan_api;

        $bscscan = Http::get($url);

        return $bscscan->json();
    }

    public function get_content()
    {
        $content = Content::first();

        $public_content = [
            'id' => $content->id,
            'balance_octa' => $content->balance_octa,
            'balance_usdt' => $content->balance_usdt
        ];

        $rs = SharedFunctions::success_msg('Success.');
        $rs['result'] = $public_content;

        return response()->json($rs);
    }
}
