<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BikeUpdateRequest extends BikeRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('bike'));
    }

    protected function failedAuthorization() {
        throw new AuthorizationException('No puedes modificar una moto que no es tuya.');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'matricula' =>
                "required_if: matriculada, 1|
                nullable|
                regex:/^\d{4}[B-Z]{3}$/i|
                unique:bikes, matriculada,$id"
        ]+parent::rules();
    }
}
