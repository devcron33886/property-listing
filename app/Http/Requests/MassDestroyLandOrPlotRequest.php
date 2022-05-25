<?php

namespace App\Http\Requests;

use App\Models\LandOrPlot;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLandOrPlotRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('land_or_plot_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:land_or_plots,id',
        ];
    }
}
