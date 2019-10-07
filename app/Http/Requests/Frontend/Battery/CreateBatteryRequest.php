<?php

namespace App\Http\Requests\Frontend\Battery;

use App\Http\FormRequestValidateOption;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SendContactRequest.
 */
class CreateBatteryRequest extends FormRequest
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
            'test_ids' => [FormRequestValidateOption::REQUIRED],
            'name' => [FormRequestValidateOption::REQUIRED]
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'test_ids.required' => 'Please add at least one test to the battery.'
        ];
    }
}
