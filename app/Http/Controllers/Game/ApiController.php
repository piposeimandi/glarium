<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function world($x, $y)
    {
        // Stub: retorna un arreglo vacío de islas
        return response()->json([]);
    }

    public function buildings()
    {
        // Stub: sin edificios por ahora
        return response()->json([]);
    }

    public function citySetWine($city, Request $request)
    {
        return response('ok');
    }

    public function islandSetWorker($city, Request $request)
    {
        return response('ok');
    }

    public function citySetScientists($city, Request $request)
    {
        return response('ok');
    }
}
