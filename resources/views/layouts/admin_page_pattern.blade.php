<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body>
@include('inc.header')

<div class="main-body">
    <div class="row">
        <div class="col-lg-2">

        </div>
        <div class="col-sm-8">
            @yield('content')
        </div>
        <div class="col-sm-2">

        </div>
    </div>
</div>


@include('inc.footer')
</body>
</html>
