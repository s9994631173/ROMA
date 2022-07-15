<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category' => 'required|min:3|max:255',
            'char' => 'required|min:3|max:255',
            'aboutItem' => 'required|min:3|max:255',
            'pack' => 'required|min:3|max:255',
            'method' => 'required|min:3|max:255'
        ];
    }

    public function messages(){
        return [
            'category.required' => 'Строка Категория не указана',
            'category.min' => 'Строка Категория должна быть от 3 до 255 символов',
            'category.max' => 'Строка Категория должна быть от 3 до 255 символов',

            'char.required' => 'Строка Характеристика не указана',
            'char.min' => 'Строка Характеристика должна быть от 3 до 255 символов',
            'char.max' => 'Строка Характеристика должна быть от 3 до 255 символов',

            'aboutItem.required' => 'Строка Описание вложения не указана',

            'pack.required' => 'Строка Упаковка не указана',
            'pack.min' => 'Строка Упаковка должна быть от 3 до 255 символов',
            'pack.max' => 'Строка Упаковка должна быть от 3 до 255 символов',

            'method.required' => 'Строка Метод не указана',
        ];
    }
}
