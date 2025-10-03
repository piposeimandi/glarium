<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getResources($city)
    {
        return response()->json(['wood'=>0,'wine'=>0,'marble'=>0,'glass'=>0,'sulfur'=>0]);
    }

    public function getPopulation($city)
    {
        return response()->json(['population'=>0,'scientists'=>0,'worker_forest'=>0,'worker_mine'=>0]);
    }

    public function getActionPoint($city)
    {
        return response()->json(['ap'=>0,'max'=>0]);
    }

    public function getCities()
    {
        // Lista mínima de ciudades para arrancar
        return response()->json([
            ['id'=>1,'name'=>'Ciudad Capital','x'=>0,'y'=>0,'capital'=>1]
        ]);
    }

    public function setScientists($city, Request $request)
    {
        return response('ok');
    }

    public function setWine($city, Request $request)
    {
        return response('ok');
    }

    public function setName($city, Request $request)
    {
        return response('ok');
    }
}
