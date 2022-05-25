@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.electronic.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.electronics.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.electronic.fields.id') }}
                        </th>
                        <td>
                            {{ $electronic->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.electronic.fields.title') }}
                        </th>
                        <td>
                            {{ $electronic->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.electronic.fields.price') }}
                        </th>
                        <td>
                            {{ $electronic->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.electronic.fields.product_image') }}
                        </th>
                        <td>
                            @if($electronic->product_image)
                                <a href="{{ $electronic->product_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $electronic->product_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.electronic.fields.description') }}
                        </th>
                        <td>
                            {{ $electronic->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.electronic.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Electronic::STATUS_SELECT[$electronic->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.electronic.fields.product_gallery') }}
                        </th>
                        <td>
                            @foreach($electronic->product_gallery as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.electronics.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection