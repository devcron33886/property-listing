<?php

namespace App\Http\Requests;

use App\Models\HouseGallery;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHouseGalleryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('house_gallery_edit');
    }

    public function rules()
    {
        return [
            'house_id' => [
                'required',
                'integer',
            ],
            'house_photos' => [
                'array',
            ],
        ];
    }
}
