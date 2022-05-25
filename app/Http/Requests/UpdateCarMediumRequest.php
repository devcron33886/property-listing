<?php

namespace App\Http\Requests;

use App\Models\CarMedium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCarMediumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('car_medium_edit');
    }

    public function rules()
    {
        return [
            'car_video' => [
                'string',
                'nullable',
            ],
            'car_gallery' => [
                'array',
            ],
        ];
    }
}
