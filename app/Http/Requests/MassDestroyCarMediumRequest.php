<?php

namespace App\Http\Requests;

use App\Models\CarMedium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCarMediumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('car_medium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:car_media,id',
        ];
    }
}
