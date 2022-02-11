<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class SignupFormRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'email'=>'required|email|unique:users,email,null,id,user_type,'.$this->user_type,
            'device_type'=>'required',
            'device_id'=>'required',
            'user_type'=>'required',
            'password'=>'required',
            'name'=>'required',
            'mobile'=>'required|unique:users,mobile,null,id,user_type,'.$this->user_type,
            'service_type'=>"required_if:user_type,0"
        ];
    }

}
