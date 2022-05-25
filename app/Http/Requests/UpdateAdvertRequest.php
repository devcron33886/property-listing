<?php

namespace App\Http\Requests;

use App\Models\Advert;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAdvertRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('advert_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'link' => [
                'string',
                'nullable',
            ],
        ];
    }
}
