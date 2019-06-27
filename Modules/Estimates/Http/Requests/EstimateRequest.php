<?php

namespace Modules\Estimates\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstimateRequest extends FormRequest
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
                'client_id' => 'required',
                'reference_no' => 'required|unique:estimates,reference_no,'.$this->id.',id',
                'tax' => 'numeric',
                'tax2' => 'numeric',
                'discount' => 'numeric',
                'due_date' => 'required|date',
                'currency' => 'required',
        ];
    }
}
