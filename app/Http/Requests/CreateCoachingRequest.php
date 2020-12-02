<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCoachingRequest extends FormRequest
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
            'name' => 'required|max:255|min:3',
            'directorname' => 'required|max:255|min:2',
            'email' => 'required|max:255|email|unique:users,name,' . $id,
            'phone' => 'required|regex:/[0-9]{10}/',
            'altphone' => 'nullable|regex:/[0-9]{10}/',
            'specialization' => 'required|max:255|min:3',
            'state' => 'max:255|min:4',
            'password' => 'max:255|min:4',
            'landmark' => 'max:255|min:4',
            'description' => 'nullable|max:255',
            'level' => 'max:255',
            'image' => 'nullable|mimes:jpeg,jpg,png',
            'address1' => 'required|max:255|min:4',
            'address2' => 'nullable|max:255',
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
