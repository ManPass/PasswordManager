@extends('layouts.app_auth')
@section('title-block')
    Recovery
@endsection

@section('content')
<div class="login-page">

<form class="login-form" action = "{{route('forgot-password-submit')}}" method="get">
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
    @if(session('message_success'))
        <div class="alert alert-success">
            {{session('message_success')}}
        </div>
        @endif
    @csrf
    <div class="form-group" >
        <label for="email">Email</label>
        <input type="text" name="login" placeholder="input email" id="login" class="form-control">
    </div>
        <button type="submit" class="btn btn-success">Submit</button>


</form>

</div>
@endsection
