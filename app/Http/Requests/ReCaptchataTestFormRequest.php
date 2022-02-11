<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReCaptchataTestFormRequest extends BaseFormRequest
{
  /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
                        'email' => 'required|email',
                        'comment' => 'required'
            'g-recaptcha-response' => ['required', new ValidRecaptcha]
        ];
    }
/**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'ReCaptcha required!',
        ];
    }
}