<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        $alats = Alat::all();
        return response()->json($alats);
    }

    public function show(Alat $alat)
    {
        return response()->json($alat);
    }
}

