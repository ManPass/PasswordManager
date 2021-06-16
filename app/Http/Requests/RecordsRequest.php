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
            'url' => 'nullable|max:50|url',
            'comment' => 'nullable|max:255',
            'tag' => 'nullable|regex:([\w]+(,[\w]+)*)|max:30'
        ];
    }
}
