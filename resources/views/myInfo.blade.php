@extends('layouts.app')

@section('Personal information')
    Main Page
@endsection

@section('content')
<h1>Info</h1>
    @foreach ( $data as $el )
        <div class="alert alert-info">
            <h3>{{$el->name}}</h3>
            <p>{{$el->accountEmail}}</p>
            <p><small>{{$role[$el->RoleID-1]["Role"]}}</small></p>
            <a href="#"><button class="btn btn-success">Detail</button></a>
        </div>
    @endforeach

@endsection
