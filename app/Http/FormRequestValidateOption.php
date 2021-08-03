<?php

namespace App\Http;

class FormRequestValidateOption {

    const REQUIRED = 'required';
    const STRING = 'string';
    const DATE = 'date';
    const EMAIL = 'email';

    public static function maxLength($length) {
        return 'max:' . $length;
    }
}
