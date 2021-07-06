@extends('layouts.app')

@section('title-block')
    Редактирование существующего пароля
@endsection

@section('content')
<div class="login-page">
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

        <form class="login-form" action="{{ route('record-update', $data->id)}}"  method="post" >
            @csrf
            <div class="form-group">
                <label for="source">От чего пароль: *</label>
                <input type="text" name="record[source]" value= "{{$data->source}}" id="source" class="form-control">
            </div>

        <div class="form-group">
            <label for="pass">Пароль: *</label>
            <input type="password" name="record[password]" value="{{$data->password}}" id="pass" class="form-control">
        </div>

            <div class="form-group">
                <label for="login">Логин:</label>
                <input type="text" name="record[login]" value="{{$data->login}}" id="login" class="form-control">
            </div>

            <div class="form-group">
                <label for="url">URL: </label>
                <input type="text" name="record[url]" value="{{$data->url}}" id="url" class="form-control">
            </div>

            <div class="form-group">
                <label for="comment">Комментарии: </label>
                <textarea name="record[comment]" value="{{$data->comment}}" id="comment" class="form-control">{{$data->comment}}</textarea>
            </div>

            <div class="form-group">
                <label for="tag">Теги (через запятую) </label>
                <input type="text" name="record[tag]" value="{{$data->tag}}" id="tag" class="form-control">
            </div>

            <div class="form-group">
                <label>* - поле является обязательным для заполнения</label>
            </div>

        <button type="submit" class="btn btn-success">Сохранить</button>
        <a href="{{ route('record-show', $data->id)}}"><button class="btn btn-success">Назад</button></a>

    </form>
    @endsection
