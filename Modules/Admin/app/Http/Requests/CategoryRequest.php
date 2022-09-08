<?php

namespace Module\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST': {
                    return [
                        "name" => "required",
                        "parent_id" => "nullable|exists:categories,id",
                        "status" => "boolean",
                    ];
                }
            case 'PUT': {
                    return [
                        "name" => "sometimes",
                        "parent_id" => "nullable|exists:categories,id|unique:categories,id,".$this->segment(3),
                        "status" => 'boolean',
                    ];
                }
        }
    }
}
