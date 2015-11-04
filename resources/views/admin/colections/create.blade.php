@extends('layout-admin')

@section('title', @trans('title.home'))

@section('content')

        <!-- REVISAR -->
    <div class="head-fixed">
        <div class="head-menu">
            <h1><span><img src="/images/icon-complements.svg"></span> <span> > </span> NUEVA COLECCIÓN </h1>
        </div>
    </div>

    <div class="container-inputs-list min-top">
        @include('partials.errors')
        {!! Form::open(['route' => 'admin.colecciones.store', 'method' => 'POST']) !!}

            @include('admin.colections.partials.filds')
            <button type="submit" class="btn btn-primary">@lang('collections.btn_new_collection')</button>

        {!! Form::close() !!}
    </div>



@endsection