<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveQuejaRequest extends FormRequest
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
            'qjs_user'       => 'required',
            'qjs_business'   => 'required',
            'qjs_queja'      => 'required',
            'qjs_response'   => '',
            'qjs_fecha_hora' => 'required',
            'qjs_status'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'qjs_user.required'       => 'El usuario es requerido',
            'qjs_business.required'   => 'El negocio es requerido',
            'qjs_queja.required'      => 'El comentario es necesario',
            'qjs_fecha_hora.required' => 'La fecha y hora es requerida',
            'qjs_status.required'     => 'El estatus es requerido',
        ];
    }
}
