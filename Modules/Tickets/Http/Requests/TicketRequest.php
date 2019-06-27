<?php

namespace Modules\Tickets\Http\Requests;

use App\Entities\CustomField;
use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
        $rules = [
            'department' => 'required|numeric',
            'subject'    => 'required',
            'user_id'    => 'sometimes|numeric',
            'body'       => 'sometimes|required',
            'uploads.*'  => 'mimes:' . get_option('allowed_files') . '|max:' . get_option('file_max_size'),
        ];
        if ($this->request->has('custom')) {
            foreach ($this->request->get('custom') as $key => $val) {
                if (CustomField::select('required')->whereName($key)->first()->required == 1) {
                    $rules['custom.' . $key] = 'required';
                }
            }
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        if ($this->request->has('custom')) {
            foreach ($this->request->get('custom') as $key => $val) {
                $messages['custom.' . $key . '.required'] = 'The field ' . $key . ' is required';
            }
        }

        return $messages;
    }
}
