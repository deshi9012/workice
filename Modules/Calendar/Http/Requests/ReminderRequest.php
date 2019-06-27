<?php

namespace Modules\Calendar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReminderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'module' => 'required',
            'module_id' => 'required',
            'reminder_date' => 'required|date|after_or_equal:now',
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
