<?php

namespace App\Http\Requests;

use App\Models\Loaction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLoactionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('loaction_create');
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
