<div class="dropdown menu-global-collection">
    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <span><img src="/images/icon-menu.svg" class="icon-button"></span>
        MENÚ
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
        <li><a href="{{ route('admin.colecciones.edit', $form) }}">EDITAR COLECCIÓN</a></li>
        <li><a href="{{ route('admin.complements.edit', $form) }}">COMPLEMENTS</a></li>
        <li><a href="{{ url('/admin/colecciones') }}">MIS COLECCIONES</a></li>
    </ul>
</div>