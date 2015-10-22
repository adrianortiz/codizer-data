@extends('layout-admin')

@section('title', @trans('title.home'))

@section('content')

    <!-- REVISAR -->
    <div class="head-menu">
        <h1><span><img src="/images/icon-complements.svg"></span> <span> > </span> COMPLEMENTS </h1>
        @include('admin.colections.complements.partials.menu')
    </div>

    <div id="collection-menu">
        <button id="btnCorto" class="btn btn-default" onclick="showModalInputs('modal-textoCorto');"><span><img src="/images/input.svg"></span>Texto corto</button>
        <button id="btnLargo" class="btn btn-default"><span><img src="/images/textarea.svg"></span>Texto largo</button>
        <button id="btnSelect" class="btn btn-default"><span><img src="/images/select.svg"></span>Selección</button>
        <button id="btnOption" class="btn btn-default"><span><img src="/images/option.svg"></span>Opción</button>
    </div>


    {!! Form::open(['route' => ['admin.inputs.show', $form->id], 'method' => 'GET|HEAD', 'id' => 'form-show']) !!}
    {!! Form::close() !!}

    <div class="container-inputs-list" id="datos">

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
                    <label for="title">Titulo del campo</label>
                    {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Ingresa un titulo']) !!}
                </div>

                <div class="form-group">
                    <label for="type_validation">Tipo de dato</label>
                    {!! Form::select('type_validation', array(
                        'val_text' => 'Alfanumerico',
                        'val_date' => 'Fecha',
                        'val_num' => 'Número',
                        'moneda' => 'Moneda',
                        'decimales' => 'Decimales'
                    ), 'alfanumerico', ['id' => 'type_validation']); !!}
                </div>

                <div class="form-group">
                    <label for="type_input">type_input</label>
                    {!! Form::text('type_input', 'input_text', ['id' => 'type_input', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Ingresa un titulo']) !!}
                </div>

                <div class="form-group">
                    <label for="form_id">form_id</label>
                    {!! Form::text('form_id', $form->id, ['id' => 'form_id', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Ingresa un titulo']) !!}
                </div>

                <div>
                    <button type="button" class="btn btn-danger" onclick="closeModalInputs('modal-textoCorto');">CANCELAR</button>
                    <button type="button" class="btn btn-primary" id="registro-textoCorto">GUARDAR</button>
                </div>

                {!! Form::close() !!}

            </div>
            <div class="builder-form-preview">

                <div class="form-preview">
                    <div class="form-group">
                        <label for="title">ASDASDSA</label>
                        {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Ingresa un titulo']) !!}
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

<div class="notificacion-text-fondo" id="modal-delete" style="display: none;">
    <div class="notificacion-text">
        <div>
            <p>Mensaje</p>
            <p>Esta acción no se puede deshacer.<br>¿Esta seguro?</p>
        </div>
        <div>
            <button id="si">Si</button>
            <button id="no">No</button>
        </div>
    </div>
</div>



{!! Form::open(['route' => ['admin.inputs.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}
@section('scripts')
    <script src="{{ asset('/js/inputs.js') }}"></script>
@endsection