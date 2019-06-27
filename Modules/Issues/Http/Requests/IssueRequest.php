<?php

namespace Modules\Issues\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IssueRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project_id' => 'required|integer',
            'code' => 'sometimes|unique:issues,code,'.$this->id.',id',
            'subject' => 'required',
            'user_id' => 'required',
            'description' => 'required'
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
