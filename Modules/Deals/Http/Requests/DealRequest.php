<?php

namespace Modules\Deals\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealRequest extends FormRequest
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
                'title' => 'required',
                'pipeline' => 'required',
                'stage_id' => 'required',
                'contact_person' => 'required',
                'deal_value' => 'numeric',
                'due_date' => 'date|after_or_equal:today',
        ];
    }
}
