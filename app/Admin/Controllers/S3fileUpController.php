<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class S3fileUpController extends Controller
{
    public function index()
    {
        return view('makepdf.s3fileup');
    }

    public function store(Request $request) {
        $uploadFile = $request->file('upFile');
        $path = Storage::disk('s3')->putFile('s3fileup', $uploadFile, 'public');
        $fullUrl = Storage::disk('s3')->url($path);
        return view('makepdf.s3fileup', ['fullURL' => $fullUrl]);
    }
}