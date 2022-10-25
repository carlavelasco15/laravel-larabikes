<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;

class ApiCreateBikeRequest extends BikeRequest
{

     /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['matricula' => 'required_if:matriculada,1|
                    nullable|
                    regex:/^\d{4}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/i|
                    unique:bikes'
            ]+parent::rules();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response([
            'status' => 'ERROR',
            'message' => 'No se superaron los criterios de validación.',
            'errors' => $validator->errors()
        ], 422);

        throw new ValidationException($validator, $response);
    }

}
