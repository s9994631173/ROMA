<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OgRequest extends FormRequest
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
            'itemName' => 'required|min:3|max:255',
            'classHazard' => 'required|max:255',
            'avia' => 'required|max:255',
            'addFee' => 'required|max:255',
            'auto' => 'required|max:255',
            'note' => 'required'
        ];
    }

    public function messages(){
        return [
            'itemName.required' => 'Не указано название вложения',
            'itemName.min' => 'Название вложения должно быть от 3 до 255 символов',
            'itemName.max' => 'Название вложения должно быть от 3 до 255 символов',

            'classHazard.max' => 'Строка Класс опасности не может быть более 255 символов',
            'classHazard.required' => 'Строка Класс не указана',

            'avia.max' => 'Строка Авиа не может быть более 255 символов',
            'avia.required' => 'Строка Авиа не указана',

            'addFee.max' => 'Строка Доп сбор не может быть более 255 символов',
            'addFee.required' => 'Строка Доп сбор не указана',

            'auto.max' => 'Строка Авто не может быть более 255 символов',
            'auto.required' => 'Строка Авто не указана',

            'note.required' => 'Строка Примечание не указана',
        ];

    }
}
