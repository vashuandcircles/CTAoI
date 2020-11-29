<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'email' => 'required|max:255|email|unique:users,name,' . $id,
            'name' => 'required|max:255|min:3',
            'password' => 'required|confirmed',
            'email' => 'required|unique:users|max:255|email',
            'gender' => 'required|max:6|min:3',
            'phone' => 'required|regex:/[0-9]{10}/|unique:users',
            'specialization' => 'required|max:255|min:3',
            'image' => 'required|mimes:jpeg,jpg,png',
            'level' => 'required|max:255',
            'state' => 'required|max:255|min:4',
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
