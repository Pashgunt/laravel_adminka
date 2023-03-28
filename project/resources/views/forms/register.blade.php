@extends('layout')
@section('title', 'ToDo - регистрация пользователя')

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <form class="col-12 mt-5" action="{{route("register.new")}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="inputName">Логин:</label>
                    @error('username')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="text" class="form-control" id="inputName" name="username" placeholder="Введите имя"
                           value="{{old("username")}}">
                </div>
                <div class="form-group">
                    <label for="inputEmail">Почта:</label>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Введите почту"
                           value="{{old("email")}}">
                </div>
                <div class="form-group">
                    <label for="inputDate">Дата Рождения:</label>
                    @error('date_birth')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="date" class="form-control" id="inputDate" name="date_birth" placeholder="Введите дату"
                           value="{{old("date_birth")}}">
                </div>
                <div class="form-group">
                    <label for="inputPassword">Пароль:</label>
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="password" class="form-control" id="inputPassword" name="password"
                           placeholder="Введите пароль">
                </div>
                <div class="form-group">
                    <label for="inputRePassword">Подтверждение пароля:</label>
                    @error('rePassword')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="password" class="form-control" id="inputRePassword" name="rePassword"
                           placeholder="Повторите пароль">
                </div>
                <button type="submit" class="btn btn-primary btn-lg active">Зарегистрироваться</button>
            </form>
        </div>
    </div>
@endsection
