<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobPostFormRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "job_title"=>"required",
            "service_type"=>'required|numeric',
            "service_sub_type"=>'required|numeric',
            "budget"=>'required|numeric',

            
        ];
    }
}
