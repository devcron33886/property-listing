<?php

namespace App\Http\Requests;

use App\Models\LandMedium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLandMediumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('land_medium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:land_media,id',
        ];
    }
}
