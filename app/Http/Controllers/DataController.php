<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        return [
            'user' => auth()->user(),
            'assetSize' => auth()->user()->totalAssetsSize
        ];
    }

    public function assets()
    {
        return auth()->user()->assets;
    }
}
