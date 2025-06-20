<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'modelo' => ['required', 'string', 'max:150'],
            'marca' => ['required', 'string', 'max:255'],
            'anio' => ['required', 'integer', 'min:1970'], // The first car was invented in 1886
            'color' => ['required', 'string', 'max:50'],
            'placa' => ['required', 'string', 'max:20', 'unique:cars']
        ];
    }
    public function messages(): array
    {
        return [
            'modelo.required' => 'El campo modelo es obligatorio.',
            'marca.required' => 'El campo marca es obligatorio.',
            'anio.required' => 'El campo año es obligatorio.',
            'color.required' => 'El campo color es obligatorio.',
            'placa.required' => 'El campo placa es obligatorio.',
            'modelo.string' => 'El campo modelo debe ser una cadena de texto.',
            'marca.string' => 'El campo marca debe ser una cadena de texto.',
            'anio.integer' => 'El campo año debe ser un número entero.',
            'color.string' => 'El campo color debe ser una cadena de texto.',
            'placa.string' => 'El campo placa debe ser una cadena de texto.',
            'placa.unique' => 'La placa ya está en uso.'
        ];
    }
}
