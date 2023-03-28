<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|
                        email',
            'password' => 'required',
        ];
    }
    public function attributes(): array
    {
        return [
            'email' => 'E-mail',
            'password' => 'Пароль',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Поле обязательно к заполнению',
            'email.email' => 'Проверьте введенные данные',
            'password.required' => 'Поле обязательно к заполнению',
        ];
    }
}
