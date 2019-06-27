<?php

namespace Modules\Extras\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VaultRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'module' => 'required',
            'module_id' => 'required',
            'key' => 'required',
            'value' => 'required'
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
