<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvocatoriaRequest extends FormRequest
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
            'title'     => ['required', 'max:255'],
            'startDate' => ['required', 'email'],
            'endDate' => ['required', 'date', 'after:startDate'],
            'period' => ['required', 'exists:periodos_catalog,nombre'],
            // 'matricula'  => ['required', 'digits_between:1,'.$rules['matricula.max'], 'unique:alumnos'],
            // 'email'      => ['required', 'string', 'email', 'max:'.$rules['email.max'], 'unique:alumnos'],
            // 'telefono'   => ['required', 'string', 'max:'.$rules['telefono.max']],
            // 'password'   => ['required', 'string', 'min:8', 'max:'.$rules['password.max'], 'confirmed'],
            // 'carrera' => ['required', 'alpha_dash'],
        ];
    }
}
