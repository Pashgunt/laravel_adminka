@extends('layout')
@section('title', 'ToDo - подтверждение регистрации')

@section ('content')
    <div class="column mt-5">
        <div class="row justify-content-center">
            <div class="position-absolute top-50 start-50 translate-middle p-3 col-md-9 border">
                <div class="text-center text-uppercase fw-weight-bold">Письмо с подтверждением регистрации
                    отправлено
                    на введенную Вами почту
                </div>
                <div class="text-center mt-3">Пройдите по ссылке, отправленной в письме, и завершите регистрацию
                </div>
                <div class="text-center mt-3">Повторная отправка формы
                    <a href="{{route("verification.send")}}">Отправить ещё раз</a>
                </div>
            </div>
        </div>
    </div>
@endsection
