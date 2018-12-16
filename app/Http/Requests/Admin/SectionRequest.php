<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class SectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $section_id = $this->isMethod('PATCH') ? ',' . $this->request->get('section_id') : '';

        return [
            'sy_id' => 'required|numeric|min:1',
            'gradelevel_id' => 'required|numeric|min:1',
            'adviser_id' => 'required|numeric|min:1',
            'name' => 'required|max:100|unique:sections,name' . $section_id
        ];
    }

    public function messages()
    {
        return [
            'sy_id.required' => 'The schoolyear field is required.',
            'sy_id.numeric' => 'The schoolyear field must be a number',
            'sy_id.min' => 'The schoolyear field value should be greater than 0',

            'gradelevel_id.required' => 'The gradelevel field is required.',
            'gradelevel_id.numeric' => 'The gradelevel field must be a number',
            'gradelevel_id.min' => 'The gradelevel field value should be greater than 0',

            'adviser_id.required' => 'The adviser field is required.',
            'adviser_id.numeric' => 'The adviser field must be a number',
            'adviser_id.min' => 'The adviser field value should be greater than 0',

            'name.required' => 'The section name field is required.',
            'name.max' => 'The section name field may not be greater than 100 characters.',
            'name.unique' => 'The section name is already taken.'
        ];
    }
}
