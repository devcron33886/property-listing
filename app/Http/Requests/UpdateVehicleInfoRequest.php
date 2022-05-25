<?php

namespace App\Http\Requests;

use App\Models\VehicleInfo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVehicleInfoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vehicle_info_edit');
    }

    public function rules()
    {
        return [
            'car_id' => [
                'required',
                'integer',
            ],
            'fuel' => [
                'required',
            ],
            'steeling' => [
                'string',
                'required',
            ],
            'transmission' => [
                'required',
            ],
        ];
    }
}
