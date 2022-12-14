<?php

namespace  Modules\Vendor\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
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
        return [
            'start'=>'sometimes|date|after:yesterday',
            'end'=>'sometimes|date|after:yesterday',
            'value'=>'sometimes',
            'type'=>'sometimes',
        ];
    }
}
