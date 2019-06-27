<?php

namespace Modules\Calendar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendarRequest extends FormRequest
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
            'module' => 'sometimes',
            'module_id' => 'required',
            'event_name' => 'required',
            'location' => 'required',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }
}
