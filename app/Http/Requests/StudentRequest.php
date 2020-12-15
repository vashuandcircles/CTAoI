<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route()->parameter('coaching');
        return [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,name,' . $id,
            'phone' => 'required|regex:/[0-9]{10}/',
            'state' => 'max:255|nullable',
            'password' => 'max:255|min:4',
            'description' => 'nullable|max:255',
            'level' => 'max:255',
            'image' => 'nullable|mimes:jpeg,jpg,png',
            'address' => 'required|max:255',
            'city' => 'required|min:4',
        ];
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
