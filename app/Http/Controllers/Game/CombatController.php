<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CombatController extends Controller
{
    public function attack($city, Request $request)
    {
        return response('ok');
    }

    public function defend($city, Request $request)
    {
        return response('ok');
    }

    public function index()
    {
        return response()->json([]);
    }
}
