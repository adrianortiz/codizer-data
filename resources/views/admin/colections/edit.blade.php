@extends('layout-admin')

@section('title', @trans('title.home'))

@section('content')



    <!-- REVISAR -->
    <div class="head-menu">
        <h1><span><img src="/images/icon-complements.svg"></span> <span> > </span> {{ $form->name  }} </h1>
        @include('admin.colections.complements.partials.menu')
    </div>




    @include('partials.errors')
    {!! Form::model($form, ['route' => ['admin.colecciones.update', $form], 'method' => 'PUT']) !!}

        @include('admin.colections.partials.filds')
        <button type="submit" class="btn btn-primary">@lang('collections.btn_edit_collection')</button>

    {!! Form::close() !!}

    @include('admin.colections.partials.delete')



@endsection