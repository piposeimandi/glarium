<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    public function getMovement()
    {
        return response()->json([]);
    }

    public function endMovement(Request $request)
    {
        return response('ok');
    }

    public function colonize($city, Request $request)
    {
        return response('ok');
    }

    public function transport($city, Request $request)
    {
        return response('ok');
    }

    public function remove($movement)
    {
        return response('ok');
    }
}
