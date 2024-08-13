<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveBusinessRequest extends FormRequest
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
            'bsn_socio'   => 'required',
            'bsn_title'   => 'required',
            'bsn_logo'    => '',
            'bsn_desc'    => '',
            'bsn_status'  => 'required',
            'bsn_horario' => '',
        ];
    }

    public function messages()
    {
        return [
            'bsn_socio.required'   => 'El socio es requerido',
            'bsn_title.required'   => 'El titulo es requerido',
            'bsn_logo.required'    => '',
            'bsn_desc.required'    => '',
            'bsn_status.required'  => 'El estatus es requerido',
            'bsn_horario.required' => '',
        ];
    }
}
