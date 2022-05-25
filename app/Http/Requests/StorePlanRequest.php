<?php

namespace App\Http\Requests;

use App\Models\Plan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePlanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('plan_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'min:10',
                'max:255',
                'required',
            ],
            'price' => [
                'required',
                'unique:plans,price',
            ],
        ];
    }
}
