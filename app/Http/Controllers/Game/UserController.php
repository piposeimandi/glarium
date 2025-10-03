<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserResources()
    {
        return response()->json([
            'trade_ship' => 5,
            'trade_ship_available' => 5,
            'gold' => 0,
        ]);
    }

    public function config()
    {
        return response()->json([
            'world' => [
                'bonus' => [
                    'tavern' => 1.0,
                    'tavern_consume' => 1,
                    'resources' => 1.0,
                ],
                'warehouse' => [
                    'level' => 1
                ],
                'distance' => [
                    'same_island' => 60,
                ],
                'load_speed_base' => 1,
                'load_speed' => 1,
                'transport' => 1,
                'colonize' => [
                    'gold' => 100,
                    'wood' => 100,
                    'population' => 10,
                ]
            ],
            'research' => [],
            'user_research' => [],
        ]);
    }

    public function unread()
    {
        return response()->json(['message'=>0,'mayor'=>0]);
    }

    public function getMayor(Request $request)
    {
        return response()->json([]);
    }

    public function getMessages(Request $request)
    {
        return response()->json(['messages'=>[]]);
    }

    public function buyTradeShip(Request $request)
    {
        return response('ok');
    }

    public function sendMessage($city, Request $request)
    {
        return response('ok');
    }

    public function deleteMessage(Request $request)
    {
        return response('ok');
    }

    public function readMessages(Request $request)
    {
        return response('ok');
    }

    public function readMessage($message)
    {
        return response('ok');
    }
}
