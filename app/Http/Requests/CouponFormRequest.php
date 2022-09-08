<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponFormRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
             return $this->getCustomerRules($this->input('class'));
    }


    public function getCustomerRules($class)
    {
        $rules = [];
        switch($class){
            case "createCoupon":
                $rules = [
                    'name'       => 'required|string',
                    'coupon_discount' => 'between:0,99.99',
                    'from' => 'required|date',
                    'to' => 'required|date',
                ];
                break;
            case "updateCoupon":
                $rules = [
                    'name'       => 'required|string',
                    'coupon_discount' => 'between:0,99.99',
                    'from' => 'required|date',
                    'to' => 'required|date',
                ];
                break;

            case "restoreCoupon":
                $rules = [
                    'coupon_id' => 'required|exists:coupons,id'
                ];
                break;

        }
        return $rules;
    }
}
