<div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        MENÚ
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <li><a href="{{ route('admin.colecciones.edit', $form) }}">EDITAR COLECCIÓN</a></li>
        <li><a href="{{ route('admin.complements.edit', $form) }}">COMPLEMENTS</a></li>
        <li><a href="{{ url('/admin/colecciones') }}">MIS COLECCIONES</a></li>
    </ul>
</div>