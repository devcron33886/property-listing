<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLoactionRequest;
use App\Http\Requests\StoreLoactionRequest;
use App\Http\Requests\UpdateLoactionRequest;
use App\Models\Location;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoactionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('loaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $loactions = Location::all();

        return view('admin.loactions.index', compact('loactions'));
    }

    public function create()
    {
        abort_if(Gate::denies('loaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.loactions.create');
    }

    public function store(StoreLoactionRequest $request)
    {
        $loaction = Location::create($request->all());

        return redirect()->route('admin.loactions.index');
    }

    public function edit(Location $loaction)
    {
        abort_if(Gate::denies('loaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.loactions.edit', compact('loaction'));
    }

    public function update(UpdateLoactionRequest $request, Location $loaction)
    {
        $loaction->update($request->all());

        return redirect()->route('admin.loactions.index');
    }

    public function show(Location $loaction)
    {
        abort_if(Gate::denies('loaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.loactions.show', compact('loaction'));
    }

    public function destroy(Location $loaction)
    {
        abort_if(Gate::denies('loaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $loaction->delete();

        return back();
    }

    public function massDestroy(MassDestroyLoactionRequest $request)
    {
        Location::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
