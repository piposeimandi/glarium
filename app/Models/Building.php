<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Building extends Model
{
    use HasFactory;
    
    protected $table = 'building';

    public function research()
    {
        return $this->hasMany(ResearchBuilding::class);
    }
}
