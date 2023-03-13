@extends('layout')
@section('title', 'Профиль')

@section('content')
    <div class="container-fluid mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            Настройки профиля
            <a href="" class="btn btn-success">Сохранить</a>
        </div>
        <div class="p-3 border rounded bg-white mb-4">
            <div class="row">
                <div class="col-3">
                    <img src="{{ $user['profile_image_path'] ? asset('storage/' . $item['profile_image_path']) : asset('assets/img/profile.jpeg') }}"
                        alt="" width="128" height="128" class="rounded-circle">
                    <div class="form-group mb-3">
                        <label class="d-block">
                            Выберите картинку
                            <input type="file" id="profile_image" name="profile_image" class="form-control" hidden>
                        </label>
                    </div>
                </div>
                <div class="col-8">
                    <div class="row mb-3 text-muted">
                        <div class="col-4">ID пользователя</div> <span>{{$user['id']}}</span>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">Language / язык</div> <span>
                            <select name="language" id="language" class="form-control">
                                <option value="" selected disabled>RU</option>
                            </select>
                        </span>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">Имя</div> <span>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Введите имя" value="{{$user['name']}}">
                        </span>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">Email</div> <span>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Введите почту" value="{{$user['email']}}">
                        </span>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">Пароль</div> <span>
                            <input type="text" class="form-control" name="password" id="password" placeholder="Введите пароль">
                        </span>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">Повторение пароля</div> <span>
                            <input type="text" class="form-control d-block w-100" name="rePassword" id="rePassword" placeholder="Введите пароль ещё раз">
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            Настройки уведомлений
        </div>
    </div>
@endsection
