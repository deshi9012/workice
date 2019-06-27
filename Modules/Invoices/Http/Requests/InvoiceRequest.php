<?php

namespace Modules\Invoices\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'id'                   => 'sometimes|required',
            'reference_no'         => 'required|unique:invoices,reference_no,' . $this->id . ',id',
            'recurrence_frequency' => 'sometimes|required',
            'client_id'            => 'required',
            'due_date'             => 'sometimes|required|date',
            'currency'             => 'required',
            'partial-due_date.*'   => 'date|after_or_equal:today',
        ];
    }
}
