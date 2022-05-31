<?php

namespace App\Http\Requests;

use App\Models\Car;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('car_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'model_year' => [
                'string',
                'required',
            ],
            'price' => [
                'required',
            ],
            'seats' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'description' => [
                'required',
            ],
            'car_image' => [
                'array',
                'required',
            ],
            'car_image.*' => [
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
        ];
    }
}
