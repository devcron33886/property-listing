<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHouseRequest;
use App\Http\Requests\StoreHouseRequest;
use App\Http\Requests\UpdateHouseRequest;
use App\Models\House;
use App\Models\Location;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class HouseController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('house_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houses = House::with(['location', 'team', 'media'])->get();

        return view('admin.houses.index', compact('houses'));
    }

    public function create()
    {
        abort_if(Gate::denies('house_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.houses.create', compact('locations'));
    }

    public function store(StoreHouseRequest $request)
    {
        $house = House::create($request->all());

        if ($request->input('house_image', false)) {
            $house->addMedia(storage_path('tmp/uploads/' . basename($request->input('house_image'))))->toMediaCollection('house_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $house->id]);
        }

        return redirect()->route('admin.houses.index');
    }

    public function edit(House $house)
    {
        abort_if(Gate::denies('house_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        $house->load('location', 'team');

        return view('admin.houses.edit', compact('house', 'locations'));
    }

    public function update(UpdateHouseRequest $request, House $house)
    {
        $house->update($request->all());

        if ($request->input('house_image', false)) {
            if (!$house->house_image || $request->input('house_image') !== $house->house_image->file_name) {
                if ($house->house_image) {
                    $house->house_image->delete();
                }
                $house->addMedia(storage_path('tmp/uploads/' . basename($request->input('house_image'))))->toMediaCollection('house_image');
            }
        } elseif ($house->house_image) {
            $house->house_image->delete();
        }

        return redirect()->route('admin.houses.index');
    }

    public function show(House $house)
    {
        abort_if(Gate::denies('house_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $house->load('location', 'team');

        return view('admin.houses.show', compact('house'));
    }

    public function destroy(House $house)
    {
        abort_if(Gate::denies('house_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $house->delete();

        return back();
    }

    public function massDestroy(MassDestroyHouseRequest $request)
    {
        House::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('house_create') && Gate::denies('house_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new House();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
