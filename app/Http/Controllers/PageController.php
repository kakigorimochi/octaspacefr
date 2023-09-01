<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function index()
    {
        $data['css'] = ['global'];
        return view('osfr.index', $data);
    }


}
