@extends('layout-admin')

@section('title', @trans('title.home'))

@section('content')

    <h1>Icon > {{ $form->name  }}</h1>

    @include('partials.errors')
    {!! Form::model($form, ['route' => ['admin.colecciones.update', $form], 'method' => 'PUT']) !!}

        @include('admin.colections.partials.filds')
        <button type="submit" class="btn btn-default">@lang('collections.btn_edit_collection')</button>

    {!! Form::close() !!}

    @include('admin.colections.partials.delete')



@endsection