<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = "about";
    public $timestamps = false;
    protected $fillable = ['ABUT_ITEM', 'ABUT_CNTN'];

    static public function getContactUs(){
        $dbTable = self::all();
        $mappedArray = $dbTable->mapWithKeys(function ($row){
            return [$row['ABUT_ITEM'] => $row['ABUT_CNTN']];
        });
        return $mappedArray->toArray();
    }

}
