@extends('layouts.app')

@section('title-block')
    Main Page
@endsection

@section('content')
<h1>Home</h1>
@endsection

@section('aside')
    @parent
    <p>additional content</p>
@endsection