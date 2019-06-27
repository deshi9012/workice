<?php

namespace Modules\Creditnotes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreditNoteRequest extends FormRequest
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
                'reference_no' => 'required|unique:credit_notes,reference_no,'.$this->id.',id',
                'client_id' => 'required|integer',
                'created_at' => 'sometimes|required|date',
                'currency' => 'required',
        ];
    }
}
