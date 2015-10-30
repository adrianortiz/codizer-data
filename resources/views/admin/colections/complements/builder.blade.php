@extends('layout-admin')

@section('title', @trans('title.home'))

@section('content')

    <!-- REVISAR -->
    <div class="head-fixed">
        <div class="head-menu">
            <h1><span><img src="/images/icon-complements.svg"></span> <span> > </span> COMPLEMENTS </h1>
            @include('admin.colections.complements.partials.menu')
        </div>

        <div id="collection-menu">
            <button id="btnCorto" class="btn btn-default" title="Agregar nuevo input al formulario" onclick="showModalInputs('modal-textoCorto');"><span><img src="{{ asset('/images/input.svg') }}"></span>Nuevo campo</button>
            <!--
            <button id="btnLargo" class="btn btn-default"><span><img src="/images/textarea.svg"></span>Texto largo</button>
            <button id="btnSelect" class="btn btn-default"><span><img src="/images/select.svg"></span>Selección</button>
            <button id="btnOption" class="btn btn-default"><span><img src="/images/option.svg"></span>Opción</button>
            -->
        </div>

    </div>


    {!! Form::open(['route' => ['admin.inputs.show', $form->id], 'method' => 'GET|HEAD', 'id' => 'form-show']) !!}
    {!! Form::close() !!}

    <div class="container-inputs-list max-top" id="datos">

        <!--
        <div class="container-input-base">
            <div>1</div>
            <div>Nombre</div>
            <div><a href="#">Edit</a></div>
            <div><a href="#">Delete</a></div>
        </div>
        -->

    </div>









    @section('complements-builder')
    <div class="notificacion-text-fondo" id="modal-textoCorto" style="display: none">
        <div class="container-builder">
            <div class="builder-form-option">
                <h2>Texto corto</h2>

                @include('partials.errors')
                {!! Form::open(['route' => 'admin.inputs.store', 'method' => 'POST', 'id' => 'form-textoCorto']) !!}

                <div class="form-group">
                    <label for="title">Título del campo</label>
                    {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Ingresa un título', 'onkeyup' => 'chagenTitleInput();']) !!}
                </div>

                <div class="form-group">
                    <label for="desc">Decripción del campo</label>
                    {!! Form::textarea('description', null, ['id' => 'description', 'class' => 'form-control', 'placeholder' => 'Ingresa una descripción', 'onkeyup' => 'chagenDescInput();', 'title' => 'Descripción']) !!}
                </div>

                <div class="form-group">
                    <label for="type_validation">Tipo de dato</label>
                    {!! Form::select('type_validation', array(
                        'val_text' => 'Alfanumerico',

                        'val_num' => 'Número',

                    ), 'alfanumerico', ['id' => 'type_validation']) !!}
                    <!--
                    'val_date' => 'Fecha',
                    'moneda' => 'Moneda',
                    'decimales' => 'Decimales'
                    -->
                </div>

                    {!! Form::hidden('type_input', 'input_text', ['id' => 'type_input', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Ingresa un titulo']) !!}
                    {!! Form::hidden('form_id', $form->id, ['id' => 'form_id', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Ingresa un titulo']) !!}

                <div>
                    <button type="button" class="btn btn-danger" onclick="closeModalInputs('modal-textoCorto');">CANCELAR</button>
                    <button type="button" class="btn btn-primary" id="registro-textoCorto">GUARDAR</button>
                </div>

                {!! Form::close() !!}

            </div>
            <div class="builder-form-preview">

                <h1 id="nav" class="page-header text-center">Vista Previa</h1>

                <div class="form-preview">
                    <div class="form-group">
                        <label for="titleChange" id="titleChangeTo">Título del campo</label><span id="descChangeTo" title="Descripción de este campo." data-toggle="tooltip" data-placement="right" style="margin-left: 5px;"> <img src="{{ asset('/images/icon-help.svg') }}"></span>
                        {!! Form::text('title', null, ['id' => 'titleChange', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Agregar información']) !!}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="alert alert-success" id="msj-success" style="display: none;">
        <div class="alert-title-success">
            Estado de la operación
            <button type="button" class="close close-alert-codizer" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <ul>
            <li>Campo agregado al formulario correctamente</li>
        </ul>
    </div>
    @endsection

@endsection

@include('admin.colections.complements.partials.alert-delete')


{!! Form::open(['route' => ['admin.inputs.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}
@section('scripts')
    <script src="{{ asset('/js/inputs.js') }}"></script>
@endsection