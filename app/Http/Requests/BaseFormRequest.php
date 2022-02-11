<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Error;

class BaseFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function response(array $errors) {
        $errorBag = [];
        foreach($errors  as $key=>$err){
            $errorBag[$key]=$err[0];
        }
        return response(['isSuccess'=>false,'message'=>"Validation Error",'result'=>["errors"=>$errorBag]], 406);
    }
}
