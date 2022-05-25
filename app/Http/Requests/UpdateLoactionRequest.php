<?php

namespace App\Http\Requests;

use App\Models\Location;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLoactionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('loaction_edit');
    }

    public function rules()
    {
        return [
            'state' => [
                'string',
                'required',
            ],
        ];
    }
}
