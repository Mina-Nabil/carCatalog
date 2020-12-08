<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    protected $table = "types";
    public $timestamps = false;

    function models(){
        return $this->hasMany('App\Models\CarModel', 'MODL_TYPE_ID');
    }

    function cars(){
        return $this->hasManyThrough('App\Models\Car', 'App\Models\CarModel', 'MODL_TYPE_ID', 'CAR_MODL_ID');
    }

    function toggle(){
        if($this->TYPE_MAIN == 0) {
            $this->TYPE_MAIN = 1;
        } else {
            $this->TYPE_MAIN = 0;
        }
        $this->save();
    }
}
