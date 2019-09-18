<?php

namespace App\Http\Requests\Frontend\Client;

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
            'first_name' => ['required'],
            'last_name' => ['required'],
            'personal_code' => ['required'],
            'email' => ['required', 'email'],
            'birth_date' => ['required', 'date'],
            'title' => ['required'],
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
