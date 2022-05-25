<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCarMediumRequest;
use App\Http\Requests\StoreCarMediumRequest;
use App\Http\Requests\UpdateCarMediumRequest;
use App\Models\Car;
use App\Models\CarMedium;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CarMediaController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('car_medium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carMedia = CarMedium::with(['car', 'media'])->get();

        return view('frontend.carMedia.index', compact('carMedia'));
    }

    public function create()
    {
        abort_if(Gate::denies('car_medium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cars = Car::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.carMedia.create', compact('cars'));
    }

    public function store(StoreCarMediumRequest $request)
    {
        $carMedium = CarMedium::create($request->all());

        foreach ($request->input('car_gallery', []) as $file) {
            $carMedium->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('car_gallery');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $carMedium->id]);
        }

        return redirect()->route('frontend.car-media.index');
    }

    public function edit(CarMedium $carMedium)
    {
        abort_if(Gate::denies('car_medium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cars = Car::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $carMedium->load('car');

        return view('frontend.carMedia.edit', compact('carMedium', 'cars'));
    }

    public function update(UpdateCarMediumRequest $request, CarMedium $carMedium)
    {
        $carMedium->update($request->all());

        if (count($carMedium->car_gallery) > 0) {
            foreach ($carMedium->car_gallery as $media) {
                if (!in_array($media->file_name, $request->input('car_gallery', []))) {
                    $media->delete();
                }
            }
        }
        $media = $carMedium->car_gallery->pluck('file_name')->toArray();
        foreach ($request->input('car_gallery', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $carMedium->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('car_gallery');
            }
        }

        return redirect()->route('frontend.car-media.index');
    }

    public function show(CarMedium $carMedium)
    {
        abort_if(Gate::denies('car_medium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carMedium->load('car');

        return view('frontend.carMedia.show', compact('carMedium'));
    }

    public function destroy(CarMedium $carMedium)
    {
        abort_if(Gate::denies('car_medium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carMedium->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarMediumRequest $request)
    {
        CarMedium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('car_medium_create') && Gate::denies('car_medium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CarMedium();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
