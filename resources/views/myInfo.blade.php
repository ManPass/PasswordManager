@extends('layouts.app')

@section('Personal information')
    Main Page
@endsection

@section('aside')
    <form action=""
@endsection

@section('content')
<h1>Список паролей:</h1>
    @foreach ( $data as $el )
        <div class="alert alert-info">
            <h2>{{$el->source}}</h3>
            <h3>{{$el->comment}}</h3>
            @if($el->login != 0)
                <p>Логин: {{$el->login}}</p>
            @endif
            @if($el->url != 0)
                <p>URL: {{$el->url}}</p>
            @endif
            <a href="#"><button class="btn btn-success">Показать пароль</button></a>
        </div>
    @endforeach

@endsection
