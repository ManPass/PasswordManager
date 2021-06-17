@extends('layouts.app_auth')
@section('title-block')
    Login
@endsection

@section('content')
<div class="login-page">

<form class="login-form" action = "{{route('login-submith')}}" method="post">
    @if(session('message'))
        <div class="alert alert-danger">
            {{session('message')}}
        </div>
    @endif
    @csrf
    <div class="form-group" >
        <label for="login">Name</label>
        <input type="text" name="login" placeholder="input login" id="login" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="input password" id="password" class="form-control">
    </div>
    
        <button type="submit" class="btn btn-success">Submit</button>
        <p class="message">Not registered? <a href="#">Create an account</a></p>
    
</form>
  
</div>
@endsection