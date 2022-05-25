<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCarRequest;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use App\Models\Location;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CarController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('car_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cars = Car::with(['location', 'team', 'media'])->get();

        return view('frontend.cars.index', compact('cars'));
    }

    public function create()
    {
        abort_if(Gate::denies('car_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.cars.create', compact('locations'));
    }

    public function store(StoreCarRequest $request)
    {
        $car = Car::create($request->all());

        if ($request->input('car_image', false)) {
            $car->addMedia(storage_path('tmp/uploads/' . basename($request->input('car_image'))))->toMediaCollection('car_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $car->id]);
        }

        return redirect()->route('frontend.cars.index');
    }

    public function edit(Car $car)
    {
        abort_if(Gate::denies('car_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        $car->load('location', 'team');

        return view('frontend.cars.edit', compact('car', 'locations'));
    }

    public function update(UpdateCarRequest $request, Car $car)
    {
        $car->update($request->all());

        if ($request->input('car_image', false)) {
            if (!$car->car_image || $request->input('car_image') !== $car->car_image->file_name) {
                if ($car->car_image) {
                    $car->car_image->delete();
                }
                $car->addMedia(storage_path('tmp/uploads/' . basename($request->input('car_image'))))->toMediaCollection('car_image');
            }
        } elseif ($car->car_image) {
            $car->car_image->delete();
        }

        return redirect()->route('frontend.cars.index');
    }

    public function show(Car $car)
    {
        abort_if(Gate::denies('car_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $car->load('location', 'team');

        return view('frontend.cars.show', compact('car'));
    }

    public function destroy(Car $car)
    {
        abort_if(Gate::denies('car_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $car->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarRequest $request)
    {
        Car::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('car_create') && Gate::denies('car_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Car();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
