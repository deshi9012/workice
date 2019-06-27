<?php

namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|unique:currencies,code,'.$this->id,
            'title' => 'required',
            'symbol' => 'required',
            'native' => 'required',
            'xrate' => 'sometimes|required',
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
