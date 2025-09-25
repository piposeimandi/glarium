<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UserCity extends Model
{
    protected $table = 'user_city';

    public $timestamps = false;

    protected $fillable = ['user_id','city_id','capital'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('city', function (Builder $builder) {
            $builder->has('city');
        });
    }
}
