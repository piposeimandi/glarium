<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movement extends Model
{
    protected $table = 'movement';

    use SoftDeletes;

    protected $fillable = [
        'start_at',
        'end_at',
        'return_at',
        'user_id',
        'city_from',
        'city_to',
        'movement_type_id',
        'trade_ship'
    ];

    protected $attributes = [
        'cancelled' => 0
    ];

    public function resources()
    {
        return $this->hasOne(MovementResource::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movement_regiment()
    {
        return $this->hasOne(MovementRegiment::class);
    }

    public function city_origin()
    {
        return $this->belongsTo(City::class,'city_from');
    }

    public function city_destine()
    {
        return $this->belongsTo(City::class,'city_to');
    }
}
