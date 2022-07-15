<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CcDdRequest extends FormRequest
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
            'contragent' => 'required|min:3|max:255',
            'contract' => 'required|min:3|max:255',
            'message' => 'required'
        ];
    }

    public function messages(){
        return [
            'contragent.required' => 'Не указано название контрагента',
            'contragent.min' => 'Название контрагента должно быть от 3 до 255 символов',
            'contragent.max' => 'Название контрагента должно быть от 3 до 255 символов',

            'contract.required' => 'Не указан договор',
            'contract.min' => 'Договор должен быть от 3 до 255 символов',
            'contract.max' => 'Договор должен быть от 3 до 255 символов',

            'message.required' => 'Не указан текст уведомления'
        ];
    }
}
