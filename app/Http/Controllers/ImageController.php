<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    function image($id)
    {
        return response()->file(storage_path("app/public/images/" . $id));
    }
}
