<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    public function getData()
    {
        return response()->json([]);
    }

    public function create($research)
    {
        return response('ok');
    }
}
