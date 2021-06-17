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
    <form action="{{ route('contact-form') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Input name" id="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" placeholder="Input email" id="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Input password" id="password" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-success">Submit</button>
        
    </form>
    </div>
@endsection