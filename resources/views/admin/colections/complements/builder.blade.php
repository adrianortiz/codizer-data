@extends('layout-admin')

@section('title', @trans('title.home'))

@section('content')

    <h1>Icon > COMPLEMENTS </h1>

    @include('admin.colections.partials.menu')

    <button id="btnCorto" onclick="showModalInputs('modal-textoCorto');">Texto corto</button>
    <button id="btnLargo">Texto largo</button>
    <button id="btnSelect">Selección</button>
    <button id="btnOption">Opción</button>



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
            <div></div>
        </div>
    </div>

    <div class="alert alert-success" id="msj-success" onclick="closeModalInputs('msj-success');" style="display: none;">
        <div class="alert-title-success">
            Estado de la operación
        </div>
        <ul>
            <li>Campo agregado al formulario correctamente</li>
        </ul>
    </div>
    @endsection

@endsection

@section('scripts')
    <script src="{{ asset('/js/inputs.js') }}"></script>
@endsection