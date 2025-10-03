<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Limpia datos previos (opcional en dev)
        DB::table('user_city')->delete();
        DB::table('user_resource')->delete();
        DB::table('city')->delete();
        DB::table('users')->delete();

        // Crea usuario
        $userId = DB::table('users')->insertGetId([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Crea ciudad
        $cityId = DB::table('city')->insertGetId([
            'constructed_at' => Carbon::now(),
            'name' => 'Capital',
            'wood' => 1000,
            'wine' => 0,
            'marble' => 0,
            'glass' => 0,
            'sulfur' => 0,
            'apoint' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ]);

        // Relación user_city (capital)
        DB::table('user_city')->insert([
            'user_id' => $userId,
            'city_id' => $cityId,
            'capital' => 1,
        ]);

        // Recursos del usuario
        DB::table('user_resource')->insert([
            'user_id' => $userId,
            'gold' => 10000,
            'research_point' => 0,
            'trade_ship' => 3,
            'trade_ship_available' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
