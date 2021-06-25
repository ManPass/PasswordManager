<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordRequest extends FormRequest
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


    public function rules()
    {
        return [
            'source' => 'required|min:2|max:50',
            'pass' => 'required|min:3|max:30|regex:(^[^а-яА-ЯёЁ]+$)',
            'login' => 'max:50',
            'url' => 'nullable|max:255|url',
            'comment' => 'nullable|max:255',
            'tag' => 'nullable|regex:([\D]+(,[\D]+)*)|max:100'

        ];
    }

    public function attributes()
    {
        return [
            'source' => 'источник',
            'pass' => 'пароль',
            'login' => 'логин',
            'url' => 'URL',
            'comment' => 'комментарий',
            'tag' => 'теги'
        ];
    }

    public function messages()
    {
        return [
            'source.required' => 'Поле \"От чего пароль\" является обязательным',
            'source.min' => '\"От чего пароль\" не может быть меньше 2 символов',
            'source.max' => '\"От чего пароль\" не может быть больше 50 символов',
            'pass.required' => 'Поле \"Пароль\" является обязательным',
            'pass.min' => 'Пароль не может быть меньше 3 символов',
            'pass.max' => 'Пароль не может быть больше 30 символов',
            'pass.regex' => 'Пароль не должен иметь кириллицу',
            'login.max' => 'Логин не может быть больше 50 символов',
            'url.max' => 'URL не может быть больше 255 символов',
            'url.url' => 'Неверный формат URL',
            'comment.max' => 'Комментарии должны быть не больше 255 символов',
            'tag.regex' => 'Теги должны быть указаны через запятую',
            'tag.max' => 'Теги должны быть не больше 100 символов'
        ];
    }
}
