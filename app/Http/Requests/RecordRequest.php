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
            'record.source' => 'required|min:2|max:50',
            'record.password' => 'required|min:3|max:30|regex:(^[^а-яА-ЯёЁ]+$)',
            'record.login' => 'max:50',
            'record.url' => 'nullable|max:255|url',
            'record.comment' => 'nullable|max:255',
            'record.tag' => 'nullable|regex:([\D]+(,[\D]+)*)|max:100'
        ];
    }

    public function attributes()
    {
        return [
            'record.source' => 'источник',
            'record.password' => 'пароль',
            'record.login' => 'логин',
            'record.url' => 'URL',
            'record.comment' => 'комментарий',
            'record.tag' => 'теги'
        ];
    }

    public function messages()
    {
        return [
            'record.source.required' => 'Поле "От чего пароль" является обязательным',
            'record.source.min' => '\"От чего пароль\" не может быть меньше 2 символов',
            'record.source.max' => '\"От чего пароль\" не может быть больше 50 символов',
            'record.password.required' => 'Поле \"Пароль\" является обязательным',
            'record.password.min' => 'Пароль не может быть меньше 3 символов',
            'record.password.max' => 'Пароль не может быть больше 30 символов',
            'record.password.regex' => 'Пароль не должен иметь кириллицу',
            'record.login.max' => 'Логин не может быть больше 50 символов',
            'record.url.max' => 'URL не может быть больше 255 символов',
            'record.url.url' => 'Неверный формат URL',
            'record.comment.max' => 'Комментарии должны быть не больше 255 символов',
            'record.tag.regex' => 'Теги должны быть указаны через запятую',
            'record.tag.max' => 'Теги должны быть не больше 100 символов'
        ];
    }
}
