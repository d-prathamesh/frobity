<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankDetailFormRequest extends BaseFormRequest
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
            'acc_num'=>"required|numeric",
            "ifsc"=>'required|min:11|max:11',
            "bank_name"=>'required'
        ];
    }


    public function messages(){
        return [
            'name.required'=>'Account holder name is required. '
        ];
    }
}
