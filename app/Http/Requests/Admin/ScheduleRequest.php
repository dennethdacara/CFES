<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ScheduleRequest extends FormRequest
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
            'section_id' => 'required',
            'subject_id' => 'required',
            'faculty_id' => 'required',
            'room_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ];
    }

    public function messages()
    {
        return [
            'end_time.after' => 'The end time field must be a time after the start time field'
        ];
    }
}
