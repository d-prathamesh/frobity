<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileFormRequest extends BaseFormRequest
{
  

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'member_id'=>'required',
            'professional_experience'=>'required',
            'city'=>'required',
            'gender'=>'required',
            'bio'=>'required',
            'longitude'=>'required|numeric',
            'latitude'=>'required|numeric'
        ];
    }
}
