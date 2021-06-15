@extends('layouts.app')

@section('Personal information')
    Main Page
@endsection

@section('content')
<h1>Info</h1>
    @foreach ( $data as $el )
        <div class="alert alert-info">
            <h3>{{$el->login}}</h3>
            <p>{{$el->password}}</p>
            
            <a href="#"><button class="btn btn-success">Detail</button></a>
        </div>
    @endforeach

@endsection
