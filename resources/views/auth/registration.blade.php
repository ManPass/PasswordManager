@extends('layouts.app_auth')

@section('title-block')
    registraion
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
    <form action="{{ route('registration-submith') }}" method="post">
        @if(session('message'))
            <div class="alert alert-danger">
                {{session('message')}}
            </div>
        @endif
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Input name" id="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="login" placeholder="Input email" id="login" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Input password" id="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Submit</button>

    </form>
    </div>
@endsection
