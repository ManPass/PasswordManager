@extends('layouts.app')

@section('Personal information')
    Main Page
@endsection

@section('aside')

@endsection

@section('content')
    <h1>Добавление пароля</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('records-form') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="source">От чего пароль: *</label>
            <input type="text" name="record[source]" placeholder="Пример: vk.com, сейф, мобила" id="source" class="form-control">
        </div>

        <div class="form-group">
            <label for="pass">Пароль: *</label>
            <input type="password" name="record[password]" placeholder="Введите пароль" id="pass" class="form-control">
        </div>

        <div class="form-group">
            <label for="login">Логин:</label>
            <input type="text" name="record[login]" placeholder="Введите логин" id="login" class="form-control">
        </div>

        <div class="form-group">
            <label for="url">URL: </label>
            <input type="text" name="record[url]" placeholder="Пример: https://mail.ya.ru/somemail" id="url" class="form-control">
        </div>

        <div class="form-group">
            <label for="comment">Комментарии: </label>
            <textarea name="record[comment]" placeholder="Введите комментарии" id="comment" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="tag">Теги (через запятую) </label>
            <input type="text" name="record[tag]" placeholder="Введите теги " id="tag" class="form-control">
        </div>

        <div class="form-group">
            <label>* - поле является обязательным для заполнения</label>
        </div>

        <label for="personal">Личный пароль</label>
        <input type="checkbox" name="personal" id="personal" value="isPersonal">

        <button type="submit" class="btn btn-success">Сохранить</button>

    </form>

    @endsection
