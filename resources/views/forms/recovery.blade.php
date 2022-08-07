@extends('layout')
@section('title', 'ToDo - восстановление пароля')

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <form class="col-12 mt-5" action="{{route("authorize.sendRecoveryMessage")}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="inputEmail">Почта:</label>
                    @if(\Illuminate\Support\Facades\Session::has('message'))
                        <div
                            class="success alert-success">{!! \Illuminate\Support\Facades\Session::get('message') !!}</div>
                    @endif
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('message')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="email" class="form-control" id="inputEmail" name="email"
                           placeholder="Введите почту" {{old('email')}}>
                </div>
                <button type="submit" class="btn btn-primary btn-lg active">Отправить новый пароль</button>
            </form>
        </div>
    </div>
@endsection
