<div class="input-group">
    {!! Form::open(['route' => ['admin.colecciones.form.data.index', $form], 'method' => 'GET', 'id' => 'form-search', 'class' => 'navbar-form navbar-left pull-right', 'role' => 'search']) !!}
        {!! Form::text('content',null, ['id' => 'content', 'placeholder' => 'Buscar...', 'class' => 'form-control', 'style' => 'height 30px !important;']) !!}
        <span class="input-group-btn">
            <button type="submit" id="btnSearch" class="btn btn-danger">Buscar</button>
        </span>
    {!! Form::close() !!}
</div>