<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToDoRequest extends FormRequest
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

    public function rules()
    {

        return [
            'task_name' => 'required|
                        string|
                        min:5|
                        max:255',
            'task_description' => 'required|
                        string|
                        min:5|
                        max:255',
            'task_image' => 'required|
                             image:png,bpm,jpg',
            'task_tags' => 'string'
        ];
    }

    public function attributes(): array
    {
        return [
            'task_name' => 'Название задачи',
            'task_description' => 'Описание задачи',
            'task_image' => 'Картинка'
        ];
    }

    /**
     * Метод для вывода всех возможных ошибок, которые появляются после прохождения по правилам валидации
     * Описанных в методе rules()
     */
    public function messages(): array
    {
        return [
            'task_name.required' => 'Поле обязательно к заполнению',
            'task_image.required' => 'Поле обязательно к заполнению',
            'task_image.image' => 'Файл должен быть типа png,bpm,jpg',
            'task_name.string' => 'Поле должно состоять из стрококвых символов',
            'mimes.string' => 'Допустимые форматы jpg, bmp, png',
            'task_name.min' => 'Минимум 5 символов',
            'task_name.max' => 'Максимум 255 символов',
            'task_description.required' => 'Поле обязательно к заполнению',
            'task_description.string' => 'Поле должно состоять из стрококвых символов',
            'task_description.min' => 'Минимум 5 символов',
            'task_description.max' => 'Максимум 255 символов',
        ];
    }
}
