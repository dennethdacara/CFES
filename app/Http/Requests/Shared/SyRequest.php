<?php

namespace App\Http\Requests\Shared;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class SyRequest extends FormRequest
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
        return [
            'start' => 'required|numeric|digits_between:1,10|max:3000',
            'end' => 'required|numeric|digits_between:1,10|max:3000'
        ];
    }
}
