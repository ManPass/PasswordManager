@extends('layouts.app_auth')
@section('title-block')
    Смена адреса эл. почты
@endsection

@section('content')
    
    <div class="login-page">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="login-form" form action="{{route('change-mail-submit',$data->id) }}" method="post">
            @if(session('message'))
                <div class="alert alert-danger">
                    {{session('message')}}
                </div>
            @endif
            @csrf
            <div class="form-group">
                <h3>Текущий адрес - {{$data->login}} 
            </div>

            <div class="form-group">
                <label for="email">Новый e-mail</label>
                <input type="text" name="email" placeholder="Введите адрес" id="login" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Подтверждение пароля</label>
                <input type="password" name="password" placeholder="Введите пароль" id="password" class="form-control">
            </div>
            
            <button type="submit" class="btn btn-success">Изменить</button>
            
        </form>
    </div>
@endsection
