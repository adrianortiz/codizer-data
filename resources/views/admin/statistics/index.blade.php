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
            <div class="menu-global-collection">
                <button id="btnCorto" class="btn btn-default" title="Generar estadistica" onclick="showModalInputs('modal-textoCorto');"><span style="margin-right: 10px;"><img src="{{ asset('/images/icon-estadistica.svg') }}"></span>Generar estadística</button>
            </div>
        </div>

        <div id="collection-menu">
            <p>Selecciona los datos de la colección a graficar.</p>
        </div>

    </div>

    <div class="container-inputs-list">

        <h1>Hola</h1>

    </div>

    {!! Form::open(['route' => ['admin.colecciones.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
    {!! Form::close() !!}


    @include('partials.alert-ajax')

@endsection

@include('admin.statistics.parcials.modal')

@section('scripts')


    <script src="{{ asset('/js/canvas/canvas2image.js') }}"></script>
    <script src="{{ asset('/js/canvas/Blob.js') }}"></script>
    <script src="{{ asset('/js/canvas/canvas-toBlob.js') }}"></script>
    <script src="{{ asset('/js/canvas/html2canvas.js') }}"></script>
    <script src="{{ asset('/js/canvas/filesaver.js') }}"></script>
    <script src="{{ asset('/js/chart.min.js') }}"></script>


    <link rel="stylesheet" href="{{ asset('/css/nv.d3.css') }}">

    <script src="{{ asset('/js/d3/d3.min.js') }}"></script>
    <script src="{{ asset('/js/d3/nv.d3.min.js') }}"></script>
    <script src="{{ asset('/js/d3/stream_layers.js') }}"></script>

    <script src="{{ asset('/js/statistics.js') }}"></script>

@endsection