<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        return response()->json([]);
    }

    public function create($city, Request $request)
    {
        return response('ok');
    }
}
