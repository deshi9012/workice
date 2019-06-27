<?php

namespace Modules\Creditnotes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyCreditsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'invoice_id' => 'required|numeric',
            'creditnote_id' => 'required|numeric|min:1',
            'credited_amount' => 'required|numeric'
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
