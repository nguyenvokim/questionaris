<?php

namespace App\Http\Requests;

use App\Http\FormRequestValidateOption;
use App\Http\Requests\CustomPasswordRule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class RegisterRequest.
 */
class RegisterRequest extends FormRequest
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
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'country' => [FormRequestValidateOption::REQUIRED],
            'profession' => [FormRequestValidateOption::REQUIRED],
            'business_name' => [FormRequestValidateOption::REQUIRED],
            'email' => ['required', 'string', 'email', Rule::unique('users')],
            'password' => CustomPasswordRule::register($this->email),
            'g-recaptcha-response' => ['required_if:captcha_status,true', 'captcha'],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
        ];
    }
}
