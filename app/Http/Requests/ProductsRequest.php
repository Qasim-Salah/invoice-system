<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            'name' => 'required|unique:products,name,' . $this->id,
            'description' => 'required',
            'section_id' => 'required|numeric|exists:sections,id',

        ];
    }

    public function messages()
    {

        return [
            'required' => 'هذا الحقل مطلوب ',
            'unique' => 'هذا القسم موجود'
        ];
    }
}
