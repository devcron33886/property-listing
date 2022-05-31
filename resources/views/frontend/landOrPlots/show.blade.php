@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.landOrPlot.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.land-or-plots.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.landOrPlot.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $landOrPlot->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.landOrPlot.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $landOrPlot->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.landOrPlot.fields.price') }}
                                    </th>
                                    <td>
                                        {{ $landOrPlot->price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.landOrPlot.fields.location') }}
                                    </th>
                                    <td>
                                        {{ $landOrPlot->location->state ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.landOrPlot.fields.area') }}
                                    </th>
                                    <td>
                                        {{ $landOrPlot->area }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.landOrPlot.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $landOrPlot->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.landOrPlot.fields.property_image') }}
                                    </th>
                                    <td>
                                        @foreach($landOrPlot->property_image as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.land-or-plots.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection