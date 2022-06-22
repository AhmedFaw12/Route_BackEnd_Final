<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvManufacturer extends Model
{
    use HasFactory;
    function ev_models(){
        return $this->hasMany(EvModel::class, "ev_manufacturer_id", "id");
    }
    function evs(){
        return $this->hasManyThrough(Ev::class, EvModel::class);//related class , through class
    }


}
