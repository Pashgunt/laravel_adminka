@extends('layout')
@section('title', 'ToDo - обновление пароля')

@section('content')

    <div class="container mt-5">
        @if(\Illuminate\Support\Facades\Session::has("message"))
            <div class="alert alert-danger">
                {!! \Illuminate\Support\Facades\Session::get("message") !!}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="mb-4 col">Обновление пароля от аккаунта с почтой {{$email}}</div>
            <form class="col" action="{{route("authorize.changePassword")}}" method="post">
                @csrf
                <input type="text" name="email" value="{{$email}}" hidden readonly>
                <div class="form-group">
                    <label for="inputPassword">Новый пароль:</label>
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="password" class="form-control" id="inputPassword" name="password"
                           placeholder="Введите пароль">
                </div>
                <div class="form-group">
                    <label for="inputRePassword">Подтверждение нового пароля:</label>
                    @error('rePassword')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="password" class="form-control" id="inputRePassword" name="rePassword"
                           placeholder="Повторите пароль">
                </div>
                <button type="submit" class="btn btn-primary btn-lg active">Обновить пароль</button>
            </form>
        </div>
    </div>

@endsection
