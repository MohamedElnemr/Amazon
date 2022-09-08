<?php

namespace  Modules\Vendor\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start'=>'required|date|after:yesterday',
            'end'=>'required|date|after:yesterday',
            'value'=>'required',
            'type'=>'required',
        ];
    }
}
