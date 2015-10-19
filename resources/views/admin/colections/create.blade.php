@extends('layout-admin')

@section('title', @trans('title.home'))

@section('content')

    <h1>Nueva colección</h1>

    @include('partials.errors')
    {!! Form::open(['route' => 'admin.colecciones.store', 'method' => 'POST']) !!}

        @include('admin.colections.partials.filds')
        <button type="submit" class="btn btn-primary">@lang('collections.btn_new_collection')</button>

    {!! Form::close() !!}



@endsection