<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleInfoRequest;
use App\Http\Requests\UpdateVehicleInfoRequest;
use App\Http\Resources\Admin\VehicleInfoResource;
use App\Models\VehicleInfo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehicleInfoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vehicle_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VehicleInfoResource(VehicleInfo::with(['car', 'team'])->get());
    }

    public function store(StoreVehicleInfoRequest $request)
    {
        $vehicleInfo = VehicleInfo::create($request->all());

        return (new VehicleInfoResource($vehicleInfo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(VehicleInfo $vehicleInfo)
    {
        abort_if(Gate::denies('vehicle_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VehicleInfoResource($vehicleInfo->load(['car', 'team']));
    }

    public function update(UpdateVehicleInfoRequest $request, VehicleInfo $vehicleInfo)
    {
        $vehicleInfo->update($request->all());

        return (new VehicleInfoResource($vehicleInfo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(VehicleInfo $vehicleInfo)
    {
        abort_if(Gate::denies('vehicle_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleInfo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
