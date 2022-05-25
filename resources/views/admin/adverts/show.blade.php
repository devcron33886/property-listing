@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.advert.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.adverts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.advert.fields.id') }}
                        </th>
                        <td>
                            {{ $advert->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.advert.fields.title') }}
                        </th>
                        <td>
                            {{ $advert->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.advert.fields.image') }}
                        </th>
                        <td>
                            @if($advert->image)
                                <a href="{{ $advert->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $advert->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.advert.fields.link') }}
                        </th>
                        <td>
                            {{ $advert->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.advert.fields.published') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $advert->published ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.adverts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection