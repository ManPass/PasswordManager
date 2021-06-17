@extends('layouts.app')

@section('Personal information')
    Main Page
@endsection

@section('aside')
<form action="{{ route('record-search') }}" method="get" >
        @csrf
        <div class="form-group">
            <label for="search">Поиск </label>
            <input type="text" name="search" placeholder="Поиск..." id="search" class="form-control">
        </div>
        <div class="form-group">
            <input type="radio" id="tag" name="choose" value="tag">
            <label for="tag">По тегам</label>
            <input type="radio" id="source" name="choose" value="source">
            <label for="source">По названию</label>
            <input type="radio" id="login" name="choose" value="login">
            <label for="login">По логину</label>
        </div>
        <div class = "form-group">
            <button type="submit" class="btn btn-primary btn-block">Найти</button>
        </div>
    </form>
@endsection
   
@section('content')
<h1>Список паролей:</h1>
        <div class = "form-group">
            <a href="{{ route('add')}}"><button class="btn btn-success">Добавить</button></a>
        </div>
    @if(isset($data) || count($data))
        @foreach ( $data as $el )
            <div class="alert alert-info">
                <h2>{{$el->source}}</h2>
                @if(isset($el->comment))
                    <h3>{{$el->comment}}</h3>
                @endif
                @if(isset($el->login))
                    <p>Логин: {{$el->login}}</p>
                @endif
                @if (isset($el->url))
                    <p>URL: {{$el->url}}</p>
                @endif
                <a href="{{ route('record-show', $el->id)}}"><button class="btn btn-success">Открыть</button></a>
            </div>
        @endforeach
    @else
        <h1>У вас нет сохранённых паролей.</h1>
    @endif
@endsection
