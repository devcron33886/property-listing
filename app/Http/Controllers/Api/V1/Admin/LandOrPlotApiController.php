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

        if ($request->input('property_image', false)) {
            $landOrPlot->addMedia(storage_path('tmp/uploads/' . basename($request->input('property_image'))))->toMediaCollection('property_image');
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

        if ($request->input('property_image', false)) {
            if (!$landOrPlot->property_image || $request->input('property_image') !== $landOrPlot->property_image->file_name) {
                if ($landOrPlot->property_image) {
                    $landOrPlot->property_image->delete();
                }
                $landOrPlot->addMedia(storage_path('tmp/uploads/' . basename($request->input('property_image'))))->toMediaCollection('property_image');
            }
        } elseif ($landOrPlot->property_image) {
            $landOrPlot->property_image->delete();
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
