<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveChatRequest extends FormRequest
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
            'cht_orig'        => '',
            'cht_dest'        => 'required',
            'cht_business'    => '',
            'cht_message'     => 'required',
            'cht_fecha_hora'  => '',
        ];
    }

    public function messages()
    {
        return [
            'cht_dest.required'       => 'El destino es requerido',
            'cht_message.required'    => 'El mensaje es requerido',
        ];
    }
}
