@extends('layouts.admin_page_pattern')

@section('title-block')
    Controller Panel
@endsection


@section('content')

    <div class="row">
        <div class="col-md-7">

            <div class="container-fluid search-container ">

                <p class="fw-bold fs-1">Users</p>
                @if($data)
                    @foreach($data as $user)
                    <div class="alert alert-info search-element" >
                        <p class="fw-bold fs-2">{{$user['login']}}</p>
                        <div class="inner-search-element">
                            <p>Role: @foreach($user['roles'] as $role) {{$role['role']}} @endforeach</p>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Add Role
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                @foreach($roles as $role )
                                    <a class="dropdown-item" href="{{route('add_role_to_user',['login'=>$user['login'],'role_id'=>$role['id']])}}">{{$role['role']}}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Delete Role
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                @foreach($user['roles'] as $role)
                                    <a class="dropdown-item" href="{{route('delete_role_to_user',['login'=>$user['login'],'role_id'=>$role['id']])}}">{{$role['role']}}</a>
                                @endforeach
                            </div>

                        </div>

                    </div>
                    @endforeach
                @endif

            </div>


        </div>
        <div class="col-md-5 search-container alert alert-info">
            <div class="container-fluid ">
                <form method="get" action="{{route("add_role")}}">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Role</span>
                        </div>
                        <input type="text" name="role" id="role" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        <div class="inner-search-element">
                            <button class="btn btn-primary" type="submit">New Role</button>
                        </div>
                    </div>
                </form>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Search by login</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                    <div class="inner-search-element">
                        <button class="btn btn-primary">Find</button>
                    </div>
                </div>
        </div>

    </div>

@endsection
