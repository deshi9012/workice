<?php

namespace Modules\Comments\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'message'          => 'required',
            'commentable_id'   => 'required',
            'commentable_type' => 'required',
            'uploads.*'        => 'mimes:' . get_option('allowed_files') . '|max:' . get_option('file_max_size'),
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'uploads.*.mimes' => 'One of your uploaded files is not allowed',
            'uploads.*.max'   => 'Sorry! Maximum allowed size for a file is ' . get_option('file_max_size') . 'KB',
        ];
    }
}
