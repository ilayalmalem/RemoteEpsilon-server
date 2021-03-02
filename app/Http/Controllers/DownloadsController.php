<?php

namespace App\Http\Controllers;

use App\Asset;
use Illuminate\Http\Request;

class DownloadsController extends Controller
{
    public function download(Asset $asset) {
        $file_path = public_path('storage/'.$asset->path);
        return response()->download($file_path);
    }
}
