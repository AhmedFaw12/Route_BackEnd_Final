<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ev extends Model
{
    use HasFactory;

    protected $table = "evs"; //it is made by default , since we used right naming convention
    protected $guarded = [];

    function user(){
        return $this->belongsTo(User::class, "user_id", "id");//we write related class , foreign key , primary key of owner
    }
    function ev_model(){
        return $this->belongsTo(EvModel::class, "ev_model_id", "id");//we write related class , foreign key , primary key of owner
    }

}
