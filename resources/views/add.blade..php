@extends('layouts.app')

@section('title-block')
    Добавление нового пароля
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
            <label for="source">От чего пароль? *</label>
            <input type="text" name="source" id="source" class="form-control">
        </div>

        <div class="form-group">
            <label for="pass">Пароль *</label>
            <input type="hidden" name="pass" id="pass" class="form-control">
        </div>
    
    </form>