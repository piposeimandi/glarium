<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function buildings()
    {
        return response()->json([]);
    }

    public function nextLevel($building)
    {
        return response()->json(['building' => (int) $building, 'nextLevel' => 1]);
    }

    public function buildingsAvaible($city, Request $request)
    {
        return response()->json([]);
    }

    public function upgrade($cityBuilding, Request $request)
    {
        return response('ok');
    }

    public function create($city, Request $request)
    {
        return response('ok');
    }
}
