<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;

    function toggle()
    {
        if ($this->CUST_ACTV == 0) {
            if (isset($this->CUST_IMGE) && strlen($this->CUST_IMGE) > 0 && isset($this->CUST_TTLE) && strlen($this->CUST_TTLE) > 0 && 
                isset($this->CUST_TEXT) && strlen($this->CUST_TEXT) > 0 )
                $this->CUST_ACTV = 1;
        } else {
            $this->CUST_ACTV = 0;
        }
        $this->save();
    }
}
