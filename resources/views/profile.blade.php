@extends('layouts.app')

@section('title-block')
    Редактирование профиля
@endsection

@section('content')
 
    <div class="alert alert-info">
        <h3>Текущий профиль
        <h3>{{$data->login}} 
        <a href="{{route('change-mail',$data->id)}}"><button class="btn btn-success">Изменить адрес эл. почты</button></a>
        <a href="{{route('change-password',$data->id)}}"><button class="btn btn-success">Изменить пароль</button></a>
        <h4>активен с {{$data->created_at}}
        
    </div>
        

@endsection
    
