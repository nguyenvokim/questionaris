<?php

namespace App\Http\Requests\Frontend\Api;

use App\Http\FormRequestValidateOption;
use App\Rules\DuplicateEmailRule;
use App\Rules\UserOrgRoleRule;
use Illuminate\Foundation\Http\FormRequest;

class InviteUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName' => [FormRequestValidateOption::REQUIRED],
            'lastName' => [FormRequestValidateOption::REQUIRED],
            'email' => [FormRequestValidateOption::EMAIL, new DuplicateEmailRule],
            'role' => [FormRequestValidateOption::REQUIRED, new UserOrgRoleRule]
        ];
    }
}
