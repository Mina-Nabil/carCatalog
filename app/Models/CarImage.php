<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{
    protected $table = "cars_images";
    public $timestamps = false;

    public function car(){
        return $this->belongsTo('App\Models\Car', 'CIMG_CAR_ID');
    } 


    public function deleteImage()
    {
        try {
            unlink(public_path('storage/' . $this->CIMG_URL));
        } catch (Exception $e) {
        }
        $this->delete();
        return;
    }

}
