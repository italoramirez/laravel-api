<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentsRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:150'],
            'lastname' => ['required', 'string', 'max:255'],
            'age' => ['required', 'string', 'min:2'],
            'document' => ['required', 'string', 'max:20'],
            'course' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
          'name.required' => 'El campo nombrees obligatorio.',
            'lastname.required' => 'El campo apellido es obligatorio.',
            'age.required' => 'El campo edad es obligatorio.',
            'document.required' => 'El campo documento es obligatorio.',
            'course.required' => 'El campo curso es obligatorio.',
            'name.string' => 'El campo nombre debe ser una cadena de texto.',
            'lastname.string' => 'El campo apellido debe ser una cadena de texto.',
            'age.string' => 'El campo edad debe ser una cadena de texto.',
            'document.string' => 'El campo documento debe ser una cadena de texto.'
        ];
    }
}
