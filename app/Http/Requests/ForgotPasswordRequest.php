<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ForgotPasswordRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|
                        email',
            'password' => Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised(),
            'rePassword' => 'required|
                             same:password',
        ];
    }

    /**
     * Метод для перевода атрибутов ошибок с en на ru
     */
    public function attributes(): array
    {
        return [
            'email' => 'E-mail',
            'password' => 'Пароль',
            'rePassword' => 'Пароль'
        ];
    }

    /**
     * Метод для вывода всех возможных ошибок, которые появляются после прохождения по правилам валидации
     * Описанных в методе rules()
     */
    public function messages(): array
    {
        return [
            'password.min' => 'Минимум 8 символов',
            'password.letters' => 'Пароль должен содержать буквы',
            'password.mixedCase' => 'Пароль должен содержать буквы верхнего и нижнего регистра',
            'password.numbers' => 'Пароль должен содержать цифры',
            'password.symbol' => 'Пароль должен содержать символы',
            'rePassword.required' => 'Поле обязательно к заполнению',
            'rePassword.same' => 'Поле должно совадать с Паролем',
        ];
    }
}
