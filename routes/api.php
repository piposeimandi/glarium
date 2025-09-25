<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Game\BuildingController;
use App\Http\Controllers\Game\CityController;
use App\Http\Controllers\Game\UserController;
use App\Http\Controllers\Game\IslandController;
use App\Http\Controllers\Game\ResearchController;
use App\Http\Controllers\Game\MovementController;
use App\Http\Controllers\Game\WorldController;
use App\Http\Controllers\Game\UnitController;
use App\Http\Controllers\Game\CombatController;
use App\Http\Controllers\Game\ChatController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
  //  return $request->user();
//});

Route::get('buildings', [BuildingController::class, 'buildings']);
Route::post('building/nextLevel/{building}', [BuildingController::class, 'nextLevel']);
Route::post('building/{city}', [BuildingController::class, 'buildingsAvaible']);
Route::put('building/upgrade/{cityBuilding}', [BuildingController::class, 'upgrade']);
Route::put('building/{city}', [BuildingController::class, 'create']);

Route::get('city/getResources/{city}', [CityController::class, 'getResources']);
Route::get('city/getPopulation/{city}', [CityController::class, 'getPopulation']);
Route::get('city/getActionPoint/{city}', [CityController::class, 'getActionPoint']);
Route::get('city/getCities', [CityController::class, 'getCities']);
Route::post('city/setScientists/{city}', [CityController::class, 'setScientists']);
Route::post('city/setWine/{city}', [CityController::class, 'setWine']);
Route::post('city/setName/{city}', [CityController::class, 'setName']);

Route::get('user/getUserResources', [UserController::class, 'getUserResources']);
Route::get('user/config', [UserController::class, 'config']);
Route::get('user/unread', [UserController::class, 'unread']);
Route::get('user/getMayor', [UserController::class, 'getMayor']);
Route::post('user/getMessages', [UserController::class, 'getMessages']);
Route::post('user/buyTradeShip', [UserController::class, 'buyTradeShip']);
Route::post('user/sendMessage/{city}', [UserController::class, 'sendMessage']);
Route::post('user/message', [UserController::class, 'deleteMessage']);
Route::put('user/readMessages', [UserController::class, 'readMessages']);
Route::put('user/readMessage/{message}', [UserController::class, 'readMessage']);

Route::post('island/donation/{island}', [IslandController::class, 'donation']);
Route::put('island/donation/{island}', [IslandController::class, 'setDonation']);
Route::post('island/setWorker/{city}', [IslandController::class, 'setWorker']);
Route::get('island/{island}', [IslandController::class, 'show']);

Route::get('research', [ResearchController::class, 'getData']);
Route::post('research/{research}', [ResearchController::class, 'create']);

Route::get('movement', [MovementController::class, 'getMovement']);
Route::put('movement', [MovementController::class, 'endMovement']);
Route::post('movement/colonize/{city}', [MovementController::class, 'colonize']);
Route::post('movement/transport/{city}', [MovementController::class, 'transport']);
Route::delete('movement/{movement}', [MovementController::class, 'remove']);

Route::get('world/{x}/{y}', [WorldController::class, 'index']);

Route::post('unit/{city}', [UnitController::class, 'create']);
Route::get('unit', [UnitController::class, 'index']);

Route::post('attack/{city}', [CombatController::class, 'attack']);
Route::post('defend/{city}', [CombatController::class, 'defend']);
Route::get('getWarReport', [CombatController::class, 'index']);

Route::post('chat/send', [ChatController::class, 'send']);
