<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProductRequest extends FormRequest
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
            // 'prd_socio'   => 'required',
            'prd_business'=> 'required',
            'prd_picture' => '',
            'prd_title'   => 'required',
            'prd_desc'    => '',
            'prd_details' => '',
            'prd_price'   => 'required',
            'prd_status'  => 'required',
            'prd_type'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            // 'prd_socio.required'   => 'El socio es requerido',
            'prd_business.required' => 'El negocio es requerido',
            'prd_picture.required'  => '',
            'prd_title.required'    => 'El nombre es requerido',
            'prd_desc.required'     => '',
            'prd_details.required'  => '',
            'prd_price.required'    => 'El precio es requerido',
            'prd_status.required'   => 'El estatus es requerido',
            'prd_type.required'     => 'El tipo es requerido',
        ];
    }
}
