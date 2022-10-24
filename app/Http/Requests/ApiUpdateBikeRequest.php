<?php

namespace App\Http\Requests;


class ApiUpdateBikeRequest extends ApiCreateBikeRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('bike');
        return [
            'matriculada' => "required_if:matriculada,1|
                                        nullable|
                                        regex:/^\d{4}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/i|
                                        unique:bikes,matriculada,$id" 
        ]+parent::rules();
    }
}
