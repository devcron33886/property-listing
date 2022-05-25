<?php

namespace App\Http\Requests;

use App\Models\Amenity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAmenityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('amenity_create');
    }

    public function rules()
    {
        return [
            'house_id' => [
                'required',
                'integer',
            ],
            'garage' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'building_age' => [
                'string',
                'nullable',
            ],
            'property_video' => [
                'string',
                'nullable',
            ],
        ];
    }
}
