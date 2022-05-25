<?php

namespace App\Http\Requests;

use App\Models\LandMedium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLandMediumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('land_medium_create');
    }

    public function rules()
    {
        return [
            'land_id' => [
                'required',
                'integer',
            ],
            'video' => [
                'string',
                'nullable',
            ],
            'plot_gallery' => [
                'array',
            ],
        ];
    }
}
