<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLoactionRequest;
use App\Http\Requests\StoreLoactionRequest;
use App\Http\Requests\UpdateLoactionRequest;
use App\Models\Loaction;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoactionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('loaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $loactions = Loaction::all();

        return view('frontend.loactions.index', compact('loactions'));
    }

    public function create()
    {
        abort_if(Gate::denies('loaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.loactions.create');
    }

    public function store(StoreLoactionRequest $request)
    {
        $loaction = Loaction::create($request->all());

        return redirect()->route('frontend.loactions.index');
    }

    public function edit(Loaction $loaction)
    {
        abort_if(Gate::denies('loaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.loactions.edit', compact('loaction'));
    }

    public function update(UpdateLoactionRequest $request, Loaction $loaction)
    {
        $loaction->update($request->all());

        return redirect()->route('frontend.loactions.index');
    }

    public function show(Loaction $loaction)
    {
        abort_if(Gate::denies('loaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.loactions.show', compact('loaction'));
    }

    public function destroy(Loaction $loaction)
    {
        abort_if(Gate::denies('loaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $loaction->delete();

        return back();
    }

    public function massDestroy(MassDestroyLoactionRequest $request)
    {
        Loaction::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
