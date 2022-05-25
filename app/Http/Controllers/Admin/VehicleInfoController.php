<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVehicleInfoRequest;
use App\Http\Requests\StoreVehicleInfoRequest;
use App\Http\Requests\UpdateVehicleInfoRequest;
use App\Models\Car;
use App\Models\VehicleInfo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehicleInfoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vehicle_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleInfos = VehicleInfo::with(['car', 'team'])->get();

        return view('admin.vehicleInfos.index', compact('vehicleInfos'));
    }

    public function create()
    {
        abort_if(Gate::denies('vehicle_info_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cars = Car::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.vehicleInfos.create', compact('cars'));
    }

    public function store(StoreVehicleInfoRequest $request)
    {
        $vehicleInfo = VehicleInfo::create($request->all());

        return redirect()->route('admin.vehicle-infos.index');
    }

    public function edit(VehicleInfo $vehicleInfo)
    {
        abort_if(Gate::denies('vehicle_info_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cars = Car::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicleInfo->load('car', 'team');

        return view('admin.vehicleInfos.edit', compact('cars', 'vehicleInfo'));
    }

    public function update(UpdateVehicleInfoRequest $request, VehicleInfo $vehicleInfo)
    {
        $vehicleInfo->update($request->all());

        return redirect()->route('admin.vehicle-infos.index');
    }

    public function show(VehicleInfo $vehicleInfo)
    {
        abort_if(Gate::denies('vehicle_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleInfo->load('car', 'team');

        return view('admin.vehicleInfos.show', compact('vehicleInfo'));
    }

    public function destroy(VehicleInfo $vehicleInfo)
    {
        abort_if(Gate::denies('vehicle_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleInfo->delete();

        return back();
    }

    public function massDestroy(MassDestroyVehicleInfoRequest $request)
    {
        VehicleInfo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
