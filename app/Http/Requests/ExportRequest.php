<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportRequest extends FormRequest
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
            'about' => 'required'
        ];
    }

    public function messages(){
        return [
            'itemName.required' => 'Не указано название вложения',
            'itemName.min' => 'Название вложения должно быть от 3 до 255 символов',
            'itemName.max' => 'Название вложения должно быть от 3 до 255 символов',

            'about.required' => 'Не указана информация'
        ];
    }
}
