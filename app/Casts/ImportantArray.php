<?php
/**
 * Created by PhpStorm.
 * User: nguyenvokim
 * Date: 2020-04-22
 * Time: 10:27
 */

namespace App\Casts;


use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ImportantArray implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        $decrypt = \Crypt::decryptString($value);
        return json_decode($decrypt, true);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        $string = json_encode($value);
        return \Crypt::encryptString($string);
    }

}