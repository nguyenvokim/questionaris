<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UserOrgRoleRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, [ \App\Models\UserOrgRole::ROLE_MASTER, \App\Models\UserOrgRole::ROLE_MEMBER, \App\Models\UserOrgRole::ROLE_SUPERVISOR ]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The role is invalid';
    }
}
