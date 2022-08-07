@extends('layout')
@section('title', 'ToDo - авторизация')

@section('content')

    <div class="container">
        @if(\Illuminate\Support\Facades\Session::has("successRecoveryPassword"))
            <div class="success alert-success">
                {!! \Illuminate\Support\Facades\Session::get('successRecoveryPassword') !!}
            </div>
        @endif
        <div class="row justify-content-center">
            <form class="col-12 mt-5" action="{{route("authorize.in")}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="inputEmail">Почта:</label>
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Введите почту">
                </div>
                <div class="form-group">
                    <label for="inputPassword">Пароль:</label>
                    <input type="password" class="form-control" id="inputPassword" name="password"
                           placeholder="Введите пароль">
                </div>
                <div class="form-group">
                    <a href="{{route("authorize.recovery")}}">Забыли пароль?</a>
                </div>
                <button type="submit" class="btn btn-primary btn-lg active">Войти</button>
            </form>
        </div>
    </div>

@endsection
