<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = "cars";
    public $timestamps = true;

    protected $casts = [
        'CAR_OFFR' => 'datetime:Y-m-d',
        'CAR_TRND' => 'datetime:Y-m-d',
        'created_at' => 'datetime:d-M-Y H:i',
        'updated_at' => 'datetime:d-M-Y H:i',
    ];

    public function model(){
        return $this->belongsTo('App\Models\CarModel', 'CAR_MODL_ID');
    }

    public function accessories(){
        return $this->belongsToMany('App\Models\Accessories', "accessories_cars", "ACCR_CAR_ID", "ACCR_ACSR_ID");
    }

    public function getAccessories(){
        return $this->join('accessories_cars', 'cars.id', '=', 'ACCR_CAR_ID')
                    ->join('accessories', 'ACCR_ACSR_ID', '=', 'accessories.id')
                    ->select('ACCR_VLUE', 'ACCR_ACSR_ID', 'ACCR_CAR_ID', 'ACSR_NAME')
                    ->get();
    }

    public function images(){
        return $this->hasMany('App\Models\CarImage', 'CIMG_CAR_ID');
    }

    public function setOffer(){
        if(isset($this->CAR_OFFR)){
            $this->CAR_OFFR = null;
        } else {
            $this->CAR_OFFR = new DateTime();
        }
        $this->save();
    }

    public function setTrending(){
        if(isset($this->CAR_TRND)){
            $this->CAR_TRND = null;
        } else {
            $this->CAR_TRND = new DateTime();
        }
        $this->save();
    }

}
