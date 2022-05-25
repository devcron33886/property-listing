<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLandMediumRequest;
use App\Http\Requests\StoreLandMediumRequest;
use App\Http\Requests\UpdateLandMediumRequest;
use App\Models\LandMedium;
use App\Models\LandOrPlot;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class LandMediaController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('land_medium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landMedia = LandMedium::with(['land', 'media'])->get();

        return view('admin.landMedia.index', compact('landMedia'));
    }

    public function create()
    {
        abort_if(Gate::denies('land_medium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lands = LandOrPlot::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.landMedia.create', compact('lands'));
    }

    public function store(StoreLandMediumRequest $request)
    {
        $landMedium = LandMedium::create($request->all());

        foreach ($request->input('plot_gallery', []) as $file) {
            $landMedium->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('plot_gallery');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $landMedium->id]);
        }

        return redirect()->route('admin.land-media.index');
    }

    public function edit(LandMedium $landMedium)
    {
        abort_if(Gate::denies('land_medium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lands = LandOrPlot::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $landMedium->load('land');

        return view('admin.landMedia.edit', compact('landMedium', 'lands'));
    }

    public function update(UpdateLandMediumRequest $request, LandMedium $landMedium)
    {
        $landMedium->update($request->all());

        if (count($landMedium->plot_gallery) > 0) {
            foreach ($landMedium->plot_gallery as $media) {
                if (!in_array($media->file_name, $request->input('plot_gallery', []))) {
                    $media->delete();
                }
            }
        }
        $media = $landMedium->plot_gallery->pluck('file_name')->toArray();
        foreach ($request->input('plot_gallery', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $landMedium->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('plot_gallery');
            }
        }

        return redirect()->route('admin.land-media.index');
    }

    public function show(LandMedium $landMedium)
    {
        abort_if(Gate::denies('land_medium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landMedium->load('land');

        return view('admin.landMedia.show', compact('landMedium'));
    }

    public function destroy(LandMedium $landMedium)
    {
        abort_if(Gate::denies('land_medium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landMedium->delete();

        return back();
    }

    public function massDestroy(MassDestroyLandMediumRequest $request)
    {
        LandMedium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('land_medium_create') && Gate::denies('land_medium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new LandMedium();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
