<?php

namespace App\Http\Requests;

use App\Entities\Teacher;
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
        $user_id = null;
        $id = $this->route()->parameter('teacher');
        if ($id)
            $user_id = Teacher::findOrFail($id)->userid;
        return [
            'email' => 'required|max:255|email|unique:users,email,' . $user_id,
            'name' => 'required|max:255|min:3',
            'gender' => 'required|max:6|min:3',
            'phone' => 'required|unique:users,phone,' . $user_id,
            'altphone' => 'nullable|regex:/[0-9]{10}/',
            'specialization' => 'required|max:255|min:3',
            'image' => 'nullable|mimes:jpeg,jpg,png',
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
    public function messages()
    {
        return [
            'email.required' => 'The email field is required.',
            'name.required' => 'The name field is required.',
            'gender.required' => 'The gender field is required.',
            'phone.required' => 'The phone field is required.',
            'specialization.required' => 'The specialization field is required.',
            'level.required' => 'The level field is required.',
            'state.required' => 'The state field is required.',
            'city.required' => 'The city field is required.',
        ];
    }
}
