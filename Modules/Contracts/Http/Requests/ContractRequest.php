<?php

namespace Modules\Contracts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // $this->user()->can('contracts_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contract_title' => 'required',
            'client_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|after_or_equal:start_date',
            'expiry_date' => 'required',
            'currency' => 'required',
            'payment_terms' => 'required',
            'termination_notice' => 'required',
        ];
    }
}
