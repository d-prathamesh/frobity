<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyPaymentFormRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'razorpay_payment_id'=>'required',
            'razorpay_subscription_id'=>'required',
            'razorpay_signature'=>'required'
        ];
    }
}
