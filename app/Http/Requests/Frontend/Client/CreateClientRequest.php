<?php

namespace App\Http\Requests\Frontend\Client;

use App\Http\FormRequestValidateOption;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SendContactRequest.
 */
class CreateClientRequest extends FormRequest
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
            'first_name' => [FormRequestValidateOption::REQUIRED, FormRequestValidateOption::maxLength(25)],
            'last_name' => [FormRequestValidateOption::REQUIRED, FormRequestValidateOption::maxLength(25)],
            'personal_code' => [FormRequestValidateOption::REQUIRED],
            'email' => [FormRequestValidateOption::REQUIRED, FormRequestValidateOption::EMAIL],
            'birth_date' => [FormRequestValidateOption::REQUIRED, FormRequestValidateOption::DATE],
            'title' => [FormRequestValidateOption::REQUIRED],
            'gender' => [FormRequestValidateOption::REQUIRED],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
        ];
    }
}
