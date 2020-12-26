<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = "home_sections";
    public $timestamps = false;

    function items()
    {
        return $this->hasMany('App\Models\SiteInfo', 'MAIN_SECT_ID');
    }

    static function setSection(string $secKey, bool $isActive)
    {
        return self::where('SECT_NAME', $secKey)->update([
            "SECT_ACTV", $isActive ? 1 : 0
        ]);
    }

    function toggle()
    {
        if ($this->SECT_ACTV == 0) {
            $this->SECT_ACTV = 1;
        } else {
            $this->SECT_ACTV = 0;
        }
        return $this->save();
    }
}
