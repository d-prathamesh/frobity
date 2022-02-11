<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialIdentityFormRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'email'=>'required',
            'provider'=>'required',
            'provider_id'=>'required',
            'user_type'=>'required',
            'device_type'=>'required',
            'device_token'=>'required',
            'service_type'=>"required_if:user_type,0"
        ];
    }
}
