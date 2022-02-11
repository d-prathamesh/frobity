<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateFormRequest extends BaseFormRequest
{
  

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'hourly_rate'=>'required',
            'professional_experience'=>'required',
            'gender'=>'required',
            'bio'=>'required',
        ];
    }
}
