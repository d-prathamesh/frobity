<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class VerifyIdentityFormRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'identity'=>'required',
            'user_type'=>'required',
            'password'=>'required'
        ];
    }

}
