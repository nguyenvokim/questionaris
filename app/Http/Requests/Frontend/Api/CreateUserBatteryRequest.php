<?php

namespace App\Http\Requests\Frontend\Api;

use App\Http\FormRequestValidateOption;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserBatteryRequest extends FormRequest
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
            'battery_id' => [FormRequestValidateOption::REQUIRED],
            'client_id' => [FormRequestValidateOption::REQUIRED],
            'start_date' => [FormRequestValidateOption::REQUIRED, FormRequestValidateOption::DATE],
            'end_date' => [FormRequestValidateOption::REQUIRED, FormRequestValidateOption::DATE],
        ];
    }
}
