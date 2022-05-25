<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreHouseGalleryRequest;
use App\Http\Requests\UpdateHouseGalleryRequest;
use App\Http\Resources\Admin\HouseGalleryResource;
use App\Models\HouseGallery;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HouseGalleryApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('house_gallery_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HouseGalleryResource(HouseGallery::with(['house'])->get());
    }

    public function store(StoreHouseGalleryRequest $request)
    {
        $houseGallery = HouseGallery::create($request->all());

        foreach ($request->input('house_photos', []) as $file) {
            $houseGallery->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('house_photos');
        }

        return (new HouseGalleryResource($houseGallery))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(HouseGallery $houseGallery)
    {
        abort_if(Gate::denies('house_gallery_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HouseGalleryResource($houseGallery->load(['house']));
    }

    public function update(UpdateHouseGalleryRequest $request, HouseGallery $houseGallery)
    {
        $houseGallery->update($request->all());

        if (count($houseGallery->house_photos) > 0) {
            foreach ($houseGallery->house_photos as $media) {
                if (!in_array($media->file_name, $request->input('house_photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $houseGallery->house_photos->pluck('file_name')->toArray();
        foreach ($request->input('house_photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $houseGallery->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('house_photos');
            }
        }

        return (new HouseGalleryResource($houseGallery))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(HouseGallery $houseGallery)
    {
        abort_if(Gate::denies('house_gallery_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseGallery->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
