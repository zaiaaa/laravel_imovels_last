<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImovelRequest extends FormRequest
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
            'endereco' => 'required|string|max:250',
            'descricao' => 'required|string',
            'proprietario'=> 'required|string',
            'foto'=> 'nullable|image|max:1024|mimes:jpg,jpeg,png,webp',
        ];
    }
}