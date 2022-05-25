<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyElectronicRequest;
use App\Http\Requests\StoreElectronicRequest;
use App\Http\Requests\UpdateElectronicRequest;
use App\Models\Electronic;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ElectronicController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('electronic_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $electronics = Electronic::with(['team', 'media'])->get();

        return view('frontend.electronics.index', compact('electronics'));
    }

    public function create()
    {
        abort_if(Gate::denies('electronic_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.electronics.create');
    }

    public function store(StoreElectronicRequest $request)
    {
        $electronic = Electronic::create($request->all());

        if ($request->input('product_image', false)) {
            $electronic->addMedia(storage_path('tmp/uploads/' . basename($request->input('product_image'))))->toMediaCollection('product_image');
        }

        foreach ($request->input('product_gallery', []) as $file) {
            $electronic->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('product_gallery');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $electronic->id]);
        }

        return redirect()->route('frontend.electronics.index');
    }

    public function edit(Electronic $electronic)
    {
        abort_if(Gate::denies('electronic_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $electronic->load('team');

        return view('frontend.electronics.edit', compact('electronic'));
    }

    public function update(UpdateElectronicRequest $request, Electronic $electronic)
    {
        $electronic->update($request->all());

        if ($request->input('product_image', false)) {
            if (!$electronic->product_image || $request->input('product_image') !== $electronic->product_image->file_name) {
                if ($electronic->product_image) {
                    $electronic->product_image->delete();
                }
                $electronic->addMedia(storage_path('tmp/uploads/' . basename($request->input('product_image'))))->toMediaCollection('product_image');
            }
        } elseif ($electronic->product_image) {
            $electronic->product_image->delete();
        }

        if (count($electronic->product_gallery) > 0) {
            foreach ($electronic->product_gallery as $media) {
                if (!in_array($media->file_name, $request->input('product_gallery', []))) {
                    $media->delete();
                }
            }
        }
        $media = $electronic->product_gallery->pluck('file_name')->toArray();
        foreach ($request->input('product_gallery', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $electronic->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('product_gallery');
            }
        }

        return redirect()->route('frontend.electronics.index');
    }

    public function show(Electronic $electronic)
    {
        abort_if(Gate::denies('electronic_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $electronic->load('team');

        return view('frontend.electronics.show', compact('electronic'));
    }

    public function destroy(Electronic $electronic)
    {
        abort_if(Gate::denies('electronic_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $electronic->delete();

        return back();
    }

    public function massDestroy(MassDestroyElectronicRequest $request)
    {
        Electronic::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('electronic_create') && Gate::denies('electronic_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Electronic();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
