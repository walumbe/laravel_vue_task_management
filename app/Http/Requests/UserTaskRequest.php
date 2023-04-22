<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'task_id' => ['required'],
            'due_date' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'remarks' => ['required', 'string', 'max:100']
        ];
    }
}
