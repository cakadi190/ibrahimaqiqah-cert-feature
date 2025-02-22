<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    public function index(Request $request)
    {
        return view('upload-image.index');
    }
}
