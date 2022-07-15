<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuideRequest extends FormRequest
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
            'button' => 'required|min:3|max:255',
            'type' => 'required|in:text,link',
            'info' => 'required'
        ];
    }

    public function messages(){
        return [
            'button.required' => 'Не указано название кнопки',
            'button.min' => 'Название кнопки должно быть от 3 до 255 символов',
            'button.max' => 'Название кнопки должно быть от 3 до 255 символов',

            'type.required' => 'Не указан тип кнопки',
            'type.in' => 'Тип кнопки может быть text/link',

            'info.required' => 'Не указано описание кнопки'
        ];
    }
}
