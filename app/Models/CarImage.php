<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{
    protected $table = "car_images";
    public $timestamps = false;

    public function car(){
        return $this->belongsTo('App\Models\Car', 'CIMG_CAR_ID');
    } 

}
