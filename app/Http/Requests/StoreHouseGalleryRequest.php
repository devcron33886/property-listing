<?php

namespace App\Http\Requests;

use App\Models\HouseGallery;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHouseGalleryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('house_gallery_create');
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
