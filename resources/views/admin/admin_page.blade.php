@extends('layouts.admin_page_pattern')

@section('title-block')
    Controller Panel
@endsection


@section('content')

    <div class="row">
        <div class="col-md-7">

            <div class="container-fluid search-container ">
                <p class="fw-bold fs-1">Users</p>
                <div class="alert alert-info search-element" >
                    <p class="fw-bold fs-2">login: some@mail.com</p>
                    <div class="inner-search-element">
                        <p>Role: admin, employee</p>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Add Role
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Role1</a>
                            <a class="dropdown-item" href="#">Role2</a>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Delete Role
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Role3</a>
                            <a class="dropdown-item" href="#">Role4</a>
                        </div>
                    </div>
                </div>
                <div class="alert alert-info search-element" >
                    <p class="fw-bold fs-2">login: Lapsha@mail.com</p>
                    <div class="inner-search-element">
                        <p>Role: admin, employee</p>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Add Role
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Role1</a>
                            <a class="dropdown-item" href="#">Role2</a>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Delete Role
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Role3</a>
                            <a class="dropdown-item" href="#">Role4</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-md-5 search-container alert alert-info">
            <div class="container-fluid ">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Role</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        <div class="inner-search-element">
                            <button class="btn btn-primary">New Role</button>
                        </div>
                    </div>

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
