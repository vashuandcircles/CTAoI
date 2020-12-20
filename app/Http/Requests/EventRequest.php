<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required|max:255|min:3',
            'starttime' => 'required|max:255|min:2',
            'endtime' => 'required|max:255|min:2',
            'smalldesc' => 'required|max:255|min:3',
            'priority' => 'required|numeric',
            'imagepath' => 'required|mimes:jpeg,jpg,png',
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
            'starttime.required' => 'The start time field is required.',
            'endtime.required' => 'The end time field is required.',
            'smalldesc.required' => 'The short description field is required.',
            'imagepath.required' => 'The image field is required.',
        ];
    }


}
