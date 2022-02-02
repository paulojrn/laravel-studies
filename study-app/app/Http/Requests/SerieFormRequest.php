<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SerieFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "nome" => "required|min:2"
        ];
    }

    public function messages(): array
    {
        return [
            "nome.required" => "O campo nome é obrigatório",
            "min" => "O campo :attribute precisa ter ao menos 2 caracteres"
        ];
    }
}
