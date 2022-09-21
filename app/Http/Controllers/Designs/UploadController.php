<?php

namespace App\Http\Controllers\Designs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    //
    public function upload(Request $request)
    {
        $this->validate($request, [
            'image' => ['required', 'mimes:png,jpg,bmp,gif', 'max:2048']
        ]);
    }
}
