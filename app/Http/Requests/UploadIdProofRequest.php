<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadIdProofRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'imagebase64'=>'required'
        ];
    }
}
