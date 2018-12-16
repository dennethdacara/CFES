<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class GradelevelRequest extends FormRequest
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
        $gradelevel_id = $this->isMethod('PATCH') ? ',' . $this->request->get('gradelevel_id') : '';

        return [
            'name' => 'required|max:20|unique:gradelevels,name' . $gradelevel_id
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The gradelevel name field is required.',
            'name.unique' => 'The gradelevel name has already been taken.'
        ];
    }
}
