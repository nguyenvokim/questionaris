<?php
namespace App\Http\Requests;

use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use LangleyFoxall\LaravelNISTPasswordRules\Rules\ContextSpecificWords;
use LangleyFoxall\LaravelNISTPasswordRules\Rules\DerivativesOfContextSpecificWords;
use LangleyFoxall\LaravelNISTPasswordRules\Rules\DictionaryWords;
use LangleyFoxall\LaravelNISTPasswordRules\Rules\RepetitiveCharacters;
use LangleyFoxall\LaravelNISTPasswordRules\Rules\SequentialCharacters;

class CustomPasswordRule extends PasswordRules {
    public static function register($username)
    {
        return [
            'required',
            'string',
            'min:8',
            'confirmed',
            new SequentialCharacters(),
            new RepetitiveCharacters(),
            new DictionaryWords(),
            new ContextSpecificWords($username),
            new DerivativesOfContextSpecificWords($username),
            //new BreachedPasswords(),
        ];
    }

    public static function changePassword($username, $oldPassword = null)
    {
        $rules = self::register($username);

        if ($oldPassword) {
            $rules = array_merge($rules, [
                'different:'.$oldPassword,
            ]);
        }

        return $rules;
    }
}