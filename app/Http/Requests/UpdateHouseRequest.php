<?php

namespace App\Http\Requests;

use App\Models\House;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHouseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('house_edit');
    }

    public function rules()
    {
        return [
            'location_id' => [
                'required',
                'integer',
            ],
            'property_title' => [
                'string',
                'required',
            ],
            'price' => [
                'required',
            ],
            'area' => [
                'string',
                'nullable',
            ],
            'bedrooms' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'house_image' => [
                'array',
                'required',
            ],
            'house_image.*' => [
                'required',
            ],
            'description' => [
                'required',
            ],
            'house_address' => [
                'string',
                'nullable',
            ],
        ];
    }
}
