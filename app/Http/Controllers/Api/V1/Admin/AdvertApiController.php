<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAdvertRequest;
use App\Http\Requests\UpdateAdvertRequest;
use App\Http\Resources\Admin\AdvertResource;
use App\Models\Advert;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdvertApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('advert_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdvertResource(Advert::all());
    }

    public function store(StoreAdvertRequest $request)
    {
        $advert = Advert::create($request->all());

        if ($request->input('image', false)) {
            $advert->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new AdvertResource($advert))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Advert $advert)
    {
        abort_if(Gate::denies('advert_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdvertResource($advert);
    }

    public function update(UpdateAdvertRequest $request, Advert $advert)
    {
        $advert->update($request->all());

        if ($request->input('image', false)) {
            if (!$advert->image || $request->input('image') !== $advert->image->file_name) {
                if ($advert->image) {
                    $advert->image->delete();
                }
                $advert->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($advert->image) {
            $advert->image->delete();
        }

        return (new AdvertResource($advert))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Advert $advert)
    {
        abort_if(Gate::denies('advert_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $advert->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
