<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoicesRequest extends FormRequest
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
            'number' => 'required',
            'due_date' => 'required',
            'section_id' => 'required|numeric|exists:sections,id',
            'product_id' => 'required|numeric|exists:products,id',
            'amount_collection' => 'required|min:1|max:10000',
            'amount_commission' => 'required',
            'discount' => 'required',
            'value_vat' => 'required',
            'rate_vat' => 'required|numeric',
            'total' => 'required',
            'note' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:20000',
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
