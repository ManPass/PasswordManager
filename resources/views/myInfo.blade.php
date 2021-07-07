@extends('layouts.app')

@section('Personal information')
    Main Page
@endsection

@section('aside')
    <form method="get" action="{{route('records-data')}}">

        <div class="form-group">
            <input type="checkbox" name="ispersonal" id="ispersonal" value="isPersonal">
            <label for="personal">Отображать личное:</label><br>
            <label for="role_choose">Фильтр ролей:</label><br>
            @foreach($roles as $role)
                <input type="checkbox" name="roles[]" id="roles[]" value="{{$role->role}}">
                <label for="roles[]">{{$role->role}}</label><br>
            @endforeach
        </div>

        <div class = "form-group">
            <button type="submit" class="btn btn-primary btn-success">Изменить</button>
        </div>
    </form>
    <form method="get" action="{{ route('search') }}">
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
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
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
    <h2>{{ App\Models\Role::find(request()->cookie('role_id'))->role }} пароли</h2>
        @forelse ( $records as $record)
            @foreach($record as $el )
                <form method="get" action="{{ route('record-show', $el->id) }}">
                    <div class="alert alert-info">
                        <h2>{{$el->source}}</h2>
                        @forelse($el->roles as $role)
                            <h5>{{$role["role"]}}</h5>
                        @empty
                            <h5>Личное</h5>
                        @endforelse
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
            <h2>Выбранная роль не имеет паролей</h2>
        @endforelse



@endsection
