<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Downpayment extends Model
{
    public $timestamps = false;
    protected $table = "downpayments"; 

    function bank(){
        return $this->belongsToMany("App\Models\Bank", "plans", "PLAN_DOWN_ID", "PLAN_BANK_ID");
    }

    function plans(){
        return $this->hasMany("App\Models\Plan", "PLAN_DOWN_ID");
    }

    function getBanks($year){
        return $this->with("bank")->bank()->wherePivot("PLAN_YEAR", $year)->get("DOWN_VLUE", "PLAN_INTR", "PLAN_INSR");
    }
}
