@extends('layout-admin')

@section('title', @trans('title.home'))

@section('content')

    @if(Session::has('message'))
        <div class="alert alert-success">
            <div class="alert-title-success">
                Estado operación
            </div>
            <ul>
                <li>{{ Session::get('message') }}</li>
            </ul>
        </div>
    @endif
    <div class="head-fixed">
        <div class="head-menu">
            <h1><span><img src="{{ asset('/images/icon-estadistica.svg') }}"></span> <span> > </span> ESTADÍSTICAS </h1>
        </div>

        <div>
            <p>Selecciona los datos de la colección a graficar.</p>
        </div>

    </div>

    <div class="container-inputs-list">

        <div class="form-container">
            <div class="form-group">
                <label for="name">Selecciona una colección</label>
                <select id="name" class="form-control" name="type_validation">
                    @foreach( $collections as $collection )
                        <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="frecuencia">Frecuencia</label>
                {!! Form::select('type_validation', array(
                    'val_text' => 'Estadisticos',
                    'val_num' => 'Graficos',
                    'val_numk' => 'Por Variable',
                ), 'frecuencia', ['id' => 'frecuencia', 'class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <a class="btn btn-primary">Enviar</a>
            </div>
            <hr>
        </div>

    </div>

    {!! Form::open(['route' => ['admin.colecciones.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
    {!! Form::close() !!}
@endsection

@section('scripts')
    <!-- <script src="{{ asset('/js/collections.js') }}"></script> -->
@endsection