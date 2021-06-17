@extends('layouts.app')

@section('title-block')
    
@endsection

@section('content')
<h1>Не забудьте закрыть страницу!</h1>
        <div class="alert alert-info">
            <h2>Пароль для {{$data->source}}</h2>
            <p>Ваш пароль: {{decrypt($data->password)}}</p>
            @if(isset($data->comment))
                <h4>Комментарий: {{$data->comment}}</h4>
            @else
                <h4>Вы не оставляли комментариев<h4>
            @endif
            @if(isset($data->login))
                <h4>Логин: {{$data->login}}</h4>
            @endif
            @if(isset($data->url))
                <h4>URL: {{$data->url}}</h4>
            @endif
            @if(isset($data->tag))
                <p>Теги: {{$data->tag}}</p>
            @else
                <p>Вы не указывали теги для этой записи</p>
            @endif
            <a href="{{ route('records-data')}}"><button class="btn btn-success">Вернуться</button></a>
            <a href="{{ route('record-edit', $data->id)}}"><button class="btn btn-success">Редактировать</button></a>
            <a href="{{ route('record-delete', $data->id)}}"><button class="btn btn-danger">Удалить</button></a>        
        </div>
@endsection