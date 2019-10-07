<?php

namespace App\Http\Requests\Frontend\Battery;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBatteryRequest extends CreateBatteryRequest
{
    /**
     * @return array
     */
    public function messages()
    {
        return [
            'test_ids.required' => 'At least one test is required to save the battery.'
        ];
    }
}
