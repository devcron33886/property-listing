<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreHouseRequest;
use App\Http\Requests\UpdateHouseRequest;
use App\Http\Resources\Admin\HouseResource;
use App\Models\House;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HouseApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('house_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HouseResource(House::with(['location', 'team'])->get());
    }

    public function store(StoreHouseRequest $request)
    {
        $house = House::create($request->all());

        foreach ($request->input('house_image', []) as $file) {
            $house->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('house_image');
        }

        return (new HouseResource($house))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(House $house)
    {
        abort_if(Gate::denies('house_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HouseResource($house->load(['location', 'team']));
    }

    public function update(UpdateHouseRequest $request, House $house)
    {
        $house->update($request->all());

        if (count($house->house_image) > 0) {
            foreach ($house->house_image as $media) {
                if (!in_array($media->file_name, $request->input('house_image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $house->house_image->pluck('file_name')->toArray();
        foreach ($request->input('house_image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $house->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('house_image');
            }
        }

        return (new HouseResource($house))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(House $house)
    {
        abort_if(Gate::denies('house_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $house->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
