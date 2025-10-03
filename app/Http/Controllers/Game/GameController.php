<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        // Podrías validar auth aquí si lo deseas
        return view('Game');
    }
}
