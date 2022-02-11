<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class VerifyOTPFormRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'email' => 'required_without:mobile',
            'mobile' => 'required_without:email',
            'user_type'=>'required',
            'otp'=>'required'
        ];
    }

}
