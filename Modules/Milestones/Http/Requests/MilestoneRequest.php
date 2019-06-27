<?php

namespace Modules\Milestones\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MilestoneRequest extends FormRequest
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
            'project_id' => 'required|numeric',
            'milestone_name' => 'required',
            'start_date' => 'required|date',
            'due_date' => 'required|after_or_equal:start_date',
        ];
    }
}
