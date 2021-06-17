<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordsRequest extends FormRequest
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
            'source' => 'required|min:2|max:50',
            'pass' => 'required|min:3|max:50',
            'login' => 'max:50',
            'url' => 'nullable|min:5|max:255|url',
            'comment' => 'nullable|max:255',
            'tag' => 'nullable|regex:([\D]+(,[\D]+)*)|max:100',
            'search' => 'nullable'
        ];
    }
}
