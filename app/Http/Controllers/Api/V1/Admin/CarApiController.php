<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\Admin\CarResource;
use App\Models\Car;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('car_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarResource(Car::with(['location', 'team'])->get());
    }

    public function store(StoreCarRequest $request)
    {
        $car = Car::create($request->all());

        if ($request->input('car_image', false)) {
            $car->addMedia(storage_path('tmp/uploads/' . basename($request->input('car_image'))))->toMediaCollection('car_image');
        }

        return (new CarResource($car))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Car $car)
    {
        abort_if(Gate::denies('car_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarResource($car->load(['location', 'team']));
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

        return (new CarResource($car))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Car $car)
    {
        abort_if(Gate::denies('car_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $car->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
