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
}
