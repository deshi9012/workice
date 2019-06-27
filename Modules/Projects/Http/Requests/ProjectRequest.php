<?php

namespace Modules\Projects\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name'        => 'required',
            'client_id'   => 'required',
            'start_date'  => 'required|date|',
            'due_date'    => 'required|date|after_or_equal:start_date',
            'currency'    => 'required',
            'description' => 'required',
        ];
    }
}
