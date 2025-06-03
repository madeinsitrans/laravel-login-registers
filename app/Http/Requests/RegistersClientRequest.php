<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistersClientRequest extends FormRequest
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
            'optIdType' => 'required|in:1,2,3,5,6,15', // ajusta los valores válidos según tu lógica
            'txtNombre' => 'required|string|max:100',
            'txtPrimerApellido' => 'string|max:100',
            'txtSegundoApellido' => 'string|max:100',
            'txtNroIdentificacion' => 'required|digits_between:5,15',
            'txtDigitoVerificacion' => 'digits:1',
            'txtEmail' => 'required|email|max:150',
            'txtPhoneNumber' => 'required|digits_between:7,15',
        ];
    }
    
    public function messages()
    {
        return [
            'optIdType.required' => 'El tipo de documento es invalido',
            'optIdType.in' => 'El tipo de documento no esta permitido',
        ];
    }
    
}
