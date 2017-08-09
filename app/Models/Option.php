<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    //
    public static function key( $key )
    {
        return self::where( 'key', $key )->first();
    }

    /**
     * Get All keys
     * @param string key
     * @return array
    **/

    public static function Allkeys( $key )
    {
        return self::where( 'key', $key )->get();
    }
}
