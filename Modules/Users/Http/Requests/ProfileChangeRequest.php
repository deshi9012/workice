<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileChangeRequest extends FormRequest
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
            'confirm_password' => 'same:password',
            'username'         => 'required|unique:users,username,' . \Auth::user()->id,
            'email'            => 'required|email|unique:users,email,' . \Auth::user()->id,
            'avatar'           => 'mimes:png,jpeg,jpg|max:1024',
            'signature'        => 'mimes:png,jpg,jpeg|max:1024',
        ];
    }
}
