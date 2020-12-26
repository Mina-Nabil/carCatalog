<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SiteInfo extends Model
{
    protected $table = "maindata";
    public $timestamps = false;
    public $fillable = ['MAIN_ITEM', 'MAIN_CNTN'];

    static public function getSiteInfo()
    {
        $infoArray = DB::table('maindata')->join('home_sections', 'MAIN_SECT_ID', '=', 'home_sections.id')
            ->select('maindata.id', 'MAIN_ITEM', 'MAIN_CNTN', 'MAIN_SECT_ID', 'SECT_NAME', 'SECT_ACTV')
            // ->where('SECT_ACTV', 1)
            ->get();

        $infoMap = [];
        foreach ($infoArray as $row) {
            $infoMap[$row->SECT_NAME][$row->MAIN_ITEM] = $row->MAIN_CNTN;
        }
        return $infoMap;
    }

    static public function setSiteInfo($item, $content)
    {
        return DB::table('maindata')->where('MAIN_ITEM', $item)->update([
            "MAIN_CNTN" => $content
        ]);
    }
}
