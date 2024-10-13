<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use Illuminate\Http\Request;

class BannersControllerApi extends Controller
{
    public function getData()
    {
        $banners = Banners::all();
        return response()->json([
            'message' => 'Success',
            'data' => $banners
        ], 200);
    }
}
