<?php

namespace App\Helpers;

use App\Models\City;
use App\Models\Movement;
use App\Models\UserResource;
use App\Models\Island;
use App\Helpers\OtherHelper;
use App\Helpers\BuildingHelper;
use App\Helpers\CombatHelper;
use App\Events\UserNotification;
use App\Helpers\CityHelper;
use App\Models\Mayor;
use App\Models\UserCity;
use App\Models\User;
use Auth;
use Carbon\Carbon;

class MovementHelper {

    public static function loadedSpeed(City $city_from,$size)
    {
        //Obtenemos el nivel del puerto para calcular su capacidad de carga
        $loaded = config('world.load_speed_base');//Carga base

        //Obtenemos el puerto
        if(BuildingHelper::building($city_from,16)!=null){
            $level = BuildingHelper::building($city_from,16)->building_level->level;
        }else{
            $level = 0;
        }

        $loaded += ($level*config('world.load_speed'));

        $loadedTime = $loaded/60;//Carga por minuto

        return $size/$loadedTime;//Retornamos el tiempo en segundos
    }

    public static function distanceTime(City $city_from,City $city_to)
    {
        //Verificamos si estan en la misma isla
        //if($city_from->islandCity->island_id === $city_to->islandCity->island_id)
        //{
            return config('world.distance.same_island');
       // }
    }

    public static function distanceTimeColonize(City $city_from,Island $island)
    {
        //Verificamos si estan en la misma isla
       // if($city_from->islandCity->island_id === $island->id)
       // {
            return config('world.distance.same_island');
       // }
    }

    public static function getActionPoint(City $city_from)
    {
        return Movement::where('city_from',$city_from->id)->where('user_id',Auth::id())->count();
    }

    public static function returnMovementResources(City $city_from)
    {
        $cities = [$city_from->id];
        self::deliveredResourcesFrom($cities);
        self::deliveredResourcesReturn($cities);
    }

    public static function returnMovementResourcesAll()
    {
        $cities = UserCity::where('user_id',Auth::id())->pluck('city_id');
        self::deliveredResourcesFrom($cities);
        self::deliveredResourcesReturn($cities);
        self::deliveredResourcesTo($cities);
        self::endUserColonize($cities);
        self::endAttack();
        self::returnAttack();
    }

    private static function endAttack()
    {
        //Obtenemos los movimientos del jugador que sean ataques
        Movement::where('user_id',Auth::id())
        ->where('movement_type_id',2)
        ->where('end_at','<',Carbon::now())
        ->where('delivered',0)->get()
        ->map(function($movement){
            CombatHelper::endAttack($movement);
        });
    }

    private static function returnAttack()
    {
        //Verificamos movimientos que ya terminaron
        Movement::where('user_id',Auth::id())
        ->where('movement_type_id',2)
        ->where('return_at','<',Carbon::now())
        ->where('delivered',1)->get()
        ->map(function($movement){
            CombatHelper::returnAttack($movement);
        });
    }

    public static function deliveredResourcesReturn($cities)
    {
        $movements = Movement::whereIn('city_from',$cities)
                            ->where('movement_type_id',1)
                            ->where('delivered',1)
                            ->where('return_at','<',Carbon::now()->addSeconds(3))->get();
        $movements->map(function($movement){
            $userResource = UserResource::where('user_id',$movement->user_id)->firstOrFail();
            //Actualizamos sus mercantes
            $userResource->trade_ship_available += $movement->trade_ship;
            $userResource->save();

            //Si fue cancelada sumamos los recursos
            if($movement->cancelled==1)
            {
                CityHelper::addResources($movement->city_origin,$movement->resources);
                $data = $movement->only(['trade_ship']);
                $data['city_id'] = $movement->city_origin->id;
                $data['resources'] = $movement->resources->only(['wood','wine','marble','glass','sulfur']);
                $data['status'] = 4;
            }
            else
            {
                $data = $movement->only(['trade_ship']);
                $data['status'] = 1;
            }
            //Avisamos del estado
            event(new UserNotification('movements',$data,$movement->user_id));

            //Borramos el movimiento
            $movement->delete();
        });
    }

    public static function deliveredResourcesFrom($cities)
    {
        //Entrega los recursos desde una ciudad
        $movements = Movement::whereIn('city_from',$cities)
                            ->where('movement_type_id',1)
                            ->where('delivered',0)
                            ->where('end_at','<',Carbon::now()->addSeconds(3))->get();
        $movements->map(function($movement){
            //Entregamos los recursos
            $city_to = $movement->city_destine;
            $city_from = $movement->city_origin;
            $resources = $movement->resources;

            CityHelper::addResources($city_to,$resources);

            //Actualizamos el estado a entregado
            $movement->delivered = 1;
            $movement->save();

            //Ingresamos notificacion a la ciudad de origen
            Mayor::create([
                'city_id'=> $city_from->id,
                'type' => 2,
                'data' => json_encode([
                    'resources'=>$resources,
                    'city_to'=>$city_to->id,
                    'city_name'=>$city_to->name
                ])
            ]);
            event(new UserNotification('advisors','mayor',$movement->user_id));

            //Ingresamos el estado de la ciudad de destino
            Mayor::create([
                'city_id'=> $city_to->id,
                'type' => 3,
                'data' => json_encode([
                    'resources'=>$resources,
                    'city_from'=>$city_from->id,
                    'city_name'=>$city_from->name
                ])
            ]);
            event(new UserNotification('advisors','mayor',$city_to->userCity->user_id));

            //Avisamos del estado
            $data['city_id'] = $city_to->id;
            $data['resources'] = $resources->only(['wood','wine','marble','glass','sulfur','city_to']);
            $data['status'] = 2;
            event(new UserNotification('movements',$data,$city_to->userCity->user_id));
        });
    }

    public static function deliveredResourcesTo($cities)
    {
        //Actualiza los recursos que llegan a una ciudad
        $movements = Movement::whereIn('city_to',$cities)
                            ->where('movement_type_id',1)
                            ->where('delivered',0)
                            ->where('end_at','<',Carbon::now()->addSeconds(3))->get();
        $movements->map(function($movement){
            //Entregamos los recursos
            $city_to = $movement->city_destine;
            $resources = $movement->resources;

            CityHelper::addResources($city_to,$resources);

            //Actualizamos el estado a entregado
            $movement->delivered = 1;
            $movement->save();

            //Avisamos del estado
            $movement->status = 3;
            event(new UserNotification('movements',$movement,$movement->user_id));
        });
    }

    public static function endUserColonize($cities)
    {
        $movements = Movement::whereIn('city_from',$cities)
                        ->where('movement_type_id',4)
                        ->where('cancelled',0)
                        ->where('end_at','<',Carbon::now()->addSeconds(3))->get();
        self::endColonize($movements);
        $movements_cancelled = Movement::whereIn('city_from',$cities)
                        ->where('movement_type_id',4)
                        ->where('cancelled',1)
                        ->where('return_at','<',Carbon::now()->addSeconds(3))->get();
        self::cancelledColonize($movements_cancelled);
    }

    private static function cancelledColonize($movements)
    {
        $movements->map(function($movement){
            //Damos los 3 mercantes y el oro
            $userResource = UserResource::where('user_id',$movement->user_id)->firstOrFail();
            $userResource->trade_ship_available += $movement->trade_ship;
            $userResource->gold += config('world.colonize.gold');
            $userResource->save();

            //devolvemos lo recursos
            $city_from = $movement->city_origin;
            $collect = UnitHelper::newCollect();
            $collect->wood = config('world.colonize.wood');
            CityHelper::addResources($city_from,$collect);

            //devolvemos poblacion
            $city_from->population->population += config('world.colonize.population');
            $city_from->population->save();

            //Avisamos del estado
            $data['island_id'] = $movement->city_destine->islandCity->island_id;
            $data['city_from'] = $movement->city_from;
            $data['trade_ship'] = $movement->trade_ship;
            $data['status'] = 5;
            event(new UserNotification('movements',$data,$movement->user_id));

            //borramos el movimiento
            $movement->city_destine->delete();
            $movement->delete();
        });
    }

    private static function endColonize($movements)
    {
        $movements->map(function($movement){
            //Damos los 3 mercantes
            $userResource = UserResource::where('user_id',$movement->user_id)->first();
            $userResource->trade_ship_available += $movement->trade_ship;
            $userResource->save();

            $movement->city_destine->constructed_at = Carbon::now();
            $movement->city_destine->save();

            //Ingresamos el estado de la ciudad de destino
            Mayor::create([
                'city_id'=> $movement->city_destine->id,
                'type' => 4,
                'data' => json_encode([
                    'city_name'=>$movement->city_destine->name
                ])
            ]);
            event(new UserNotification('advisors','mayor',$movement->user_id));

            //Avisamos del estado
            $data['island_id'] = $movement->city_destine->islandCity->island_id;
            $data['trade_ship'] = $movement->trade_ship;
            $data['status'] = 3;
            event(new UserNotification('movements',$data,$movement->user_id));

            $movement->delete();

        });
    }
}
