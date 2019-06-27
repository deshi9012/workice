<?php

namespace Modules\Extras\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CallRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject' => 'required',
            'module' => 'required',
            'module_id' => 'required|numeric',
            'type' => 'required',
            'assignee' => 'required|numeric',
            'scheduled_date' => 'sometimes|date|after_or_equal:now',
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
