@extends('layouts.app')

@section('title-block')
    Main Page
@endsection

@section('content')
<h1>Home</h1>
Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ducimus aliquam perferendis 
nihil necessitatibus rerum enim, aspernatur veritatis est itaque eaque beatae quisquam, 
voluptatibus iure, debitis eius iste! Ipsam, cumque aperiam.
@endsection

@section('aside')
    @parent
    <p>additional content</p>
@endsection