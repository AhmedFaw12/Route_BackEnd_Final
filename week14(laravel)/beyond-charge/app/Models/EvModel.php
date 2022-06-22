<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvModel extends Model
{
    use HasFactory;
    function evs(){
        return $this->hasMany(Ev::class, "user_id", "id");
    }

    function ev_model(){
        return $this->belongsTo(EvManufacturer::class, "ev_manufacturer_id", "id");//we write related class , foreign key , primary key of owner
    }


}
