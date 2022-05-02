<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'password' => 'required|same:confirm-password',
            'status' => 'required',
            'role_id' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:20000',


        ];
    }

    public function messages()
    {

        return [
            'required' => 'هذا الحقل مطلوب ',
            'unique' => 'هذا البريد موجود'
        ];
    }
}
