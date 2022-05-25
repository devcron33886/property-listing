<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreElectronicRequest;
use App\Http\Requests\UpdateElectronicRequest;
use App\Http\Resources\Admin\ElectronicResource;
use App\Models\Electronic;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ElectronicApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('electronic_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ElectronicResource(Electronic::with(['team'])->get());
    }

    public function store(StoreElectronicRequest $request)
    {
        $electronic = Electronic::create($request->all());

        if ($request->input('product_image', false)) {
            $electronic->addMedia(storage_path('tmp/uploads/' . basename($request->input('product_image'))))->toMediaCollection('product_image');
        }

        foreach ($request->input('product_gallery', []) as $file) {
            $electronic->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('product_gallery');
        }

        return (new ElectronicResource($electronic))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Electronic $electronic)
    {
        abort_if(Gate::denies('electronic_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ElectronicResource($electronic->load(['team']));
    }

    public function update(UpdateElectronicRequest $request, Electronic $electronic)
    {
        $electronic->update($request->all());

        if ($request->input('product_image', false)) {
            if (!$electronic->product_image || $request->input('product_image') !== $electronic->product_image->file_name) {
                if ($electronic->product_image) {
                    $electronic->product_image->delete();
                }
                $electronic->addMedia(storage_path('tmp/uploads/' . basename($request->input('product_image'))))->toMediaCollection('product_image');
            }
        } elseif ($electronic->product_image) {
            $electronic->product_image->delete();
        }

        if (count($electronic->product_gallery) > 0) {
            foreach ($electronic->product_gallery as $media) {
                if (!in_array($media->file_name, $request->input('product_gallery', []))) {
                    $media->delete();
                }
            }
        }
        $media = $electronic->product_gallery->pluck('file_name')->toArray();
        foreach ($request->input('product_gallery', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $electronic->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('product_gallery');
            }
        }

        return (new ElectronicResource($electronic))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Electronic $electronic)
    {
        abort_if(Gate::denies('electronic_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $electronic->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
