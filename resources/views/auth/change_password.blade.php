@extends('layouts.app_auth')
@section('title-block')
    Recovery
@endsection

@section('content')
<div class="login-page">

<form class="login-form" action = "{{route('reset-password-submit')}}" method="post">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('message'))
        <div class="alert alert-danger">
            {{session('message')}}
        </div>
    @endif
    @csrf
    <input type="hidden" name="reset_token" value={{$token}} >
    <div class="form-group" >
        <label for="email">password</label>
        <input type="password" name="password" placeholder="Input password" id="password"  class="form-control">
    </div>
    <div class="form-group" >
        <label for="email">Confirm the password</label>
        <input type="password" name="password_confirm" placeholder="Confirm password" id="password_confirm"  class="form-control">
    </div>
        <button type="submit" class="btn btn-success">Submit</button>
</form>

</div>
@endsection
