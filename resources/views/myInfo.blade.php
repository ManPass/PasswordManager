@extends('layouts.app')

@section('Personal information')
    Main Page
@endsection

@section('aside')
    <form method="get" action="{{route('change-role')}}">
        <div class="form-group">
            <label for="role_choose">Сменить роль</label>
            <select class="form-control" name="role_choose" id="role_choose" value="{{request()->cookie('p')}}">
                @foreach($roles as $role)
                    <option value={{$role["id"]}}
                    @if($role["id"] == old('role_choose', request()->cookie('p')))
                        selected="selected"
                        @endif
                    >{{$role["role"]}}</option>
                @endforeach
            </select>
        </div>
        <div class = "form-group">
            <button type="submit" class="btn btn-primary btn-success">Изменить</button>
        </div>
    </form>
<form method="get" action="{{ route('search') }}>
        <div class="form-group">
            <label for="search">Поиск </label>
            <input type="text" name="search" placeholder="Поиск..." id="search" class="form-control">
        </div>
        <div class="form-group">
            <input type="radio" id="tag" name="choose" value="tag">
            <label for="tag">По тегам</label>
            <input type="radio" id="source" name="choose" value="source">
            <label for="source">По названию</label>
            <input type="radio" id="login" name="choose" value="login">
            <label for="login">По логину</label>
        </div>
        <div class = "form-group">
            <button type="submit" class="btn btn-primary btn-success">Найти</button>
        </div>
</form>
@endsection

@section('content')
    @if(request()->get('search') !== null)
        <h1>Результаты поиска по "{{request()->get('search')}}"</h1>
        <form method="get" action="{{route('records-data')}}">
            <div class = "form-group">
                <button type="submit" class="btn btn-primary btn-success">Полный список</button>
            </div>
        </form>
    @else
        <h1>Список паролей:</h1>
        <form method="get" action="{{route('add')}}">
            <div class = "form-group">
                <button type="submit" class="btn btn-primary btn-success">Добавить</button>
            </div>
        </form>
    @endif
        @forelse ( $data as $one)
            @foreach($one as $el )
        <form method="get" action="{{ route('record-show', $el->id) }}">
            <div class="alert alert-info">
                <h2>{{$el->source}}</h2>
                @if(isset($el->comment))
                    <h3>{{$el->comment}}</h3>
                @endif
                @if(isset($el->login))
                    <p>Логин: {{$el->login}}</p>
                @endif
                @if (isset($el->url))
                    <p>URL: {{$el->url}}</p>
                @endif
                <button type="submit" class="btn btn-success">Показать</button>
            </div>
        </form>
            @endforeach
        @empty
            <h1>У вас нет сохранённых паролей.</h1>
        @endforelse

@endsection
