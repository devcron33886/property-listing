<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreLandOrPlotRequest;
use App\Http\Requests\UpdateLandOrPlotRequest;
use App\Http\Resources\Admin\LandOrPlotResource;
use App\Models\LandOrPlot;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LandOrPlotApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('land_or_plot_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LandOrPlotResource(LandOrPlot::with(['location', 'team'])->get());
    }

    public function store(StoreLandOrPlotRequest $request)
    {
        $landOrPlot = LandOrPlot::create($request->all());

        foreach ($request->input('property_image', []) as $file) {
            $landOrPlot->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('property_image');
        }

        return (new LandOrPlotResource($landOrPlot))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(LandOrPlot $landOrPlot)
    {
        abort_if(Gate::denies('land_or_plot_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LandOrPlotResource($landOrPlot->load(['location', 'team']));
    }

    public function update(UpdateLandOrPlotRequest $request, LandOrPlot $landOrPlot)
    {
        $landOrPlot->update($request->all());

        if (count($landOrPlot->property_image) > 0) {
            foreach ($landOrPlot->property_image as $media) {
                if (!in_array($media->file_name, $request->input('property_image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $landOrPlot->property_image->pluck('file_name')->toArray();
        foreach ($request->input('property_image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $landOrPlot->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('property_image');
            }
        }

        return (new LandOrPlotResource($landOrPlot))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(LandOrPlot $landOrPlot)
    {
        abort_if(Gate::denies('land_or_plot_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landOrPlot->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
