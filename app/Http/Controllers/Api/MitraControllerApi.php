<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use Illuminate\Http\Request;

class MitraControllerApi extends Controller
{
    public function getData()
    {
        $banners = Mitra::all();
        return response()->json([
            'message' => 'Success',
            'data' => $banners
        ], 200);
    }
}

