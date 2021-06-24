@extends('layouts.app_auth')
@section('title-block')
    Смена пароля
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
    <form class="login-form"  form action="{{route('change-password-submit',$data->id) }}" method="post">
        @if(session('message'))
            <div class="alert alert-danger">
                {{session('message')}}
            </div>
        @endif
        @csrf
        <div class="form-group">
            <label for="password1">Старый пароль</label>
            <input type="password" name="password1" placeholder="Введите пароль" id="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="password2">Новый пароль</label>
            <input type="password" name="password2" placeholder="Введите пароль" id="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="password3">Новый пароль ещё раз</label>
            <input type="password" name="password3" placeholder="Введите пароль" id="password" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-success">Изменить</button>
        
    </form>
    </div>
@endsection