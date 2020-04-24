<?php
/**
 * Created by PhpStorm.
 * User: nguyenvokim
 * Date: 2020-04-22
 * Time: 09:59
 */

namespace App\Casts;


use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ImportantString implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return \Crypt::decryptString($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return \Crypt::encryptString($value);
    }

}