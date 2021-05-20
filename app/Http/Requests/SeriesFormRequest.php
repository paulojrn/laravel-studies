<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
            'name' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            // 'required' => 'O campo :attribute é obrigatório', // generic
            'name.required' => 'O campo nome é obrigatório', // specific            
            'name.min' => 'O campo nome precisa ter no mínimo 3 caracteres'
        ];
    }
}
