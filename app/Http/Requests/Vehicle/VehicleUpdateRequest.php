<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;
use \App\Rules\PlateVehicle;

class VehicleUpdateRequest extends FormRequest
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
            'plate' => ['required', 'string', new PlateVehicle],
            'model' => ['required', 'string'],
            'color' => ['required', 'string'],
            'type' => ['required', 'string', 'in:car,motorcycle'],
        ];
    }
}
