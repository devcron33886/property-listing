<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoactionRequest;
use App\Http\Requests\UpdateLoactionRequest;
use App\Http\Resources\Admin\LoactionResource;
use App\Models\Loaction;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoactionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('loaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LoactionResource(Loaction::all());
    }

    public function store(StoreLoactionRequest $request)
    {
        $loaction = Loaction::create($request->all());

        return (new LoactionResource($loaction))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Loaction $loaction)
    {
        abort_if(Gate::denies('loaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LoactionResource($loaction);
    }

    public function update(UpdateLoactionRequest $request, Loaction $loaction)
    {
        $loaction->update($request->all());

        return (new LoactionResource($loaction))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Loaction $loaction)
    {
        abort_if(Gate::denies('loaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $loaction->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
