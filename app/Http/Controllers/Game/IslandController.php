<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IslandController extends Controller
{
    public function setWorker($city, Request $request)
    {
        return response('ok');
    }

    public function donation($island, Request $request)
    {
        return response('ok');
    }

    public function setDonation($island, Request $request)
    {
        return response('ok');
    }

    public function show($island)
    {
        return response()->json([
            'id' => (int) $island,
            'focusCity' => null,
            'cities' => []
        ]);
    }
}
