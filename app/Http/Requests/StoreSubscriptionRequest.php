<?php

namespace App\Http\Requests;

use App\Models\Subscription;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSubscriptionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('subscription_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'plan_id' => [
                'required',
                'integer',
            ],
            'start_from' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_at' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
