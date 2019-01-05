<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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

        $user_id = $this->isMethod('patch') ? ',' . $this->request->get('user_id') : '';

        return [
            'role_id' => 'required|numeric',
            'firstname' => 'required|max:255',
            'middlename' => 'nullable|max:255',
            'lastname' => 'required|max:255',
            'gender' => 'required',
            'email' => 'email|required|max:255|unique:users,email' . $user_id
        ];
    }
}
