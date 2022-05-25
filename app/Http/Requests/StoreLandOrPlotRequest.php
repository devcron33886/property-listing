<?php

namespace App\Http\Requests;

use App\Models\LandOrPlot;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLandOrPlotRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('land_or_plot_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'area' => [
                'string',
                'required',
            ],
            'description' => [
                'required',
            ],
        ];
    }
}
