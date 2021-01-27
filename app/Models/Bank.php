<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public $timestamps = false;
    protected $table = "banks"; 

    function plans(){
        return $this->hasMany('App\Models\Plan', "PLAN_BANK_ID");
    }

    function deleteAll(){
        $this->plans()->delete();
        $this->delete();
    }
}
