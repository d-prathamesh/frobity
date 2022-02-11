<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;
use  App\Mail\SendOtpMail;


class SendOTPFormRequest extends BaseFormRequest
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
        ];
    }

}
