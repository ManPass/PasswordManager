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
    
    <form action="{{ route('records-form')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="source">От чего пароль: *</label>
            <input type="text" name="source" placeholder="Пример: vk.com, сейф, мобила" id="source" class="form-control">
        </div>

        <div class="form-group">
            <label for="pass">Пароль: *</label>
            <input type="password" name="pass" placeholder="Введите пароль" id="pass" class="form-control">
        </div>

        <div class="form-group">
            <label for="login">Логин:</label>
            <input type="text" name="login" placeholder="Введите логин" id="login" class="form-control">
        </div>

        <div class="form-group">
            <label for="url">URL: </label>
            <input type="text" name="url" placeholder="Пример: https://mail.ya.ru/somemail" id="url" class="form-control">
        </div>

        <div class="form-group">
            <label for="comment">Комментарии: </label>
            <textarea name="comment" placeholder="Введите комментарии" id="comment" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="tag">Теги (через запятую) </label>
            <input type="text" name="tag" placeholder="Введите теги " id="tag" class="form-control">
        </div>

        <div class="form-group">
            <label>* - поле является обязательным для заполнения</label>
        </div>

        <button type="submit" class="btn btn-success">Сохранить</button>
    
    </form>
    
    @endsection