<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHouseGalleryRequest;
use App\Http\Requests\StoreHouseGalleryRequest;
use App\Http\Requests\UpdateHouseGalleryRequest;
use App\Models\House;
use App\Models\HouseGallery;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class HouseGalleryController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('house_gallery_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseGalleries = HouseGallery::with(['house', 'media'])->get();

        return view('admin.houseGalleries.index', compact('houseGalleries'));
    }

    public function create()
    {
        abort_if(Gate::denies('house_gallery_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houses = House::pluck('property_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.houseGalleries.create', compact('houses'));
    }

    public function store(StoreHouseGalleryRequest $request)
    {
        $houseGallery = HouseGallery::create($request->all());

        foreach ($request->input('house_photos', []) as $file) {
            $houseGallery->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('house_photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $houseGallery->id]);
        }

        return redirect()->route('admin.house-galleries.index');
    }

    public function edit(HouseGallery $houseGallery)
    {
        abort_if(Gate::denies('house_gallery_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houses = House::pluck('property_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $houseGallery->load('house');

        return view('admin.houseGalleries.edit', compact('houseGallery', 'houses'));
    }

    public function update(UpdateHouseGalleryRequest $request, HouseGallery $houseGallery)
    {
        $houseGallery->update($request->all());

        if (count($houseGallery->house_photos) > 0) {
            foreach ($houseGallery->house_photos as $media) {
                if (!in_array($media->file_name, $request->input('house_photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $houseGallery->house_photos->pluck('file_name')->toArray();
        foreach ($request->input('house_photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $houseGallery->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('house_photos');
            }
        }

        return redirect()->route('admin.house-galleries.index');
    }

    public function show(HouseGallery $houseGallery)
    {
        abort_if(Gate::denies('house_gallery_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseGallery->load('house');

        return view('admin.houseGalleries.show', compact('houseGallery'));
    }

    public function destroy(HouseGallery $houseGallery)
    {
        abort_if(Gate::denies('house_gallery_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseGallery->delete();

        return back();
    }

    public function massDestroy(MassDestroyHouseGalleryRequest $request)
    {
        HouseGallery::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('house_gallery_create') && Gate::denies('house_gallery_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new HouseGallery();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
