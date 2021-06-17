<!--
тупо скопировал add, но поменял на динамические тайтл, значение полей ввода и т.д.
пароль отображается точечками!!!!!
-->
@extends('layouts.app')

@section('title-block')
    Редактирование существующего пароля
@endsection

@section('content')
    <h1>Изменение {{$data->source}}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('record-update', $data->id)}}" method="post">
        @csrf
        <div class="form-group">
            <label for="source">От чего пароль: *</label>
            <input type="text" name="source" value= "{{$data->source}}" id="source" class="form-control">
        </div>

        <div class="form-group">
            <label for="pass">Пароль: *</label>
            <input type="password" name="pass" value="{{$data->password}}" id="pass" class="form-control">
        </div>

        <div class="form-group">
            <label for="login">Логин:</label>
            <input type="text" name="login" value="{{$data->login}}" id="login" class="form-control">
        </div>

        <div class="form-group">
            <label for="url">URL: </label>
            <input type="text" name="url" value="{{$data->url}}" id="url" class="form-control">
        </div>

        <div class="form-group">
            <label for="comment">Комментарии: </label>
            <textarea name="comment" value="{{$data->comment}}" id="comment" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="tag">Теги (через запятую) </label>
            <input type="text" name="tag" value="{{$data->tag}}" id="tag" class="form-control">
        </div>

        <div class="form-group">
            <label>* - поле является обязательным для заполнения</label>
        </div>

        <button type="submit" class="btn btn-success">Сохранить</button>
    
    </form>
    @endsection
    