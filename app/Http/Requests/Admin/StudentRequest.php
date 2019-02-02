<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class StudentRequest extends FormRequest
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

        $student_id = $this->isMethod('patch') ? ',' . $this->request->get('student_id') : '';
        $user_id = $this->isMethod('patch') ? ',' . $this->request->get('user_id') : '';

        return [
            'student_no' => 'required|unique:students,student_no' . $student_id,
            'lrn' => 'nullable|numeric|digits:12|unique:students,lrn' . $student_id,
            'gradelevel_id' => 'required|numeric',
            'section_id' => 'required|numeric',
            // 'email' => 'required|email|unique:users,email' . $user_id,
            'gender' => 'required'
        ];
    }
}
