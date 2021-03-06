<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public $timestamps = false;
    protected $table = "plans";

    function bank()
    {
        return $this->belongsTo("App\Models\Bank", "PLAN_BANK_ID");
    }

    function downpayment()
    {
        return $this->belongsTo("App\Models\Downpayment", "PLAN_DOWN_ID");
    }

    function toggle(){
        $this->PLAN_ACTV = (1 + $this->PLAN_ACTV) % 2;
        $this->save();
    }

    static function getYearsByDownpayment($downpaymentID)
    {
        return self::where("PLAN_DOWN_ID", $downpaymentID)->where("PLAN_ACTV", 1)->selectRaw("DISTINCT PLAN_YEAR")->get();
    }

    static function getPlansByDownpaymentAndYear($downpaymentID, $year, $isEmployed)
    {
        return self::join('banks', 'banks.id', '=', 'PLAN_BANK_ID')->where("PLAN_YEAR", $year)->where("PLAN_EMPL", $isEmployed)
            ->where("PLAN_DOWN_ID", $downpaymentID)->where("PLAN_ACTV", 1)->select("plans.id", "BANK_NAME", "PLAN_INTR", "PLAN_INSR", "BANK_EXPN")->get();
    }
}
