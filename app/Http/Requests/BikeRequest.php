<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BikeRequest extends FormRequest
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
            'marca' => 'required|max:255',
            'modelo' => ['required', 'max:255', 'min:0'],
            'precio' => 'required|numeric|min:0',
            'kms' => 'required|integer|min:0',
            'matriculada' => 'required_with:matricula',
            'matricula' => "required_if:matriculada,1|
                            nullable|
                            regex:/^\d{4}[B-Z]{3}$/i|
                            unique:bikes|
                            confirmed",
            'color' => 'nullable|regex:/^#[\dA-F]{6}$/i',
            'imagen' => 'sometimes|file|image|mimes:jpg,png,gif,webp|max:2048'
    ];
    }
}
