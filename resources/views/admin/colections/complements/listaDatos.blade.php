@extends('layout-admin')

@section('title', @trans('title.home'))

@section('content')

    <!-- REVISAR -->
    <div class="head-menu">
        <h1><span><img src="/images/icon-complements.svg"></span> <span> > </span> GESTIONAR DATOs: COLECCIÓN {{ $form->name  }}</h1>
        @include('admin.colections.complements.partials.menu')
    </div>


    <table class="table table-condensed">
        <thead>
        <tr>
            <th>#</th>
            @foreach($dTitlesColums as $dTitlesColum)
                <th>{{ $dTitlesColum->dtitle }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>

            @foreach($arrayRows as $arrayRow)
                <tr>
                    <th scope="row">{{ $numList++ }}</th>
                    @foreach($arrayRow++ as $row)
                        <td>{{ $row->content }}</td>
                        <div style="display: none;">{{ $rowIdDelete = $row->row_id }}</div>
                    @endforeach
                    <td>
                        <a href="#" class="input-delete" onclick="eliminarInput(this, {{ $rowIdDelete }});">
                            <span>
                                <img src="/images/icon-delete.svg">
                            </span>
                        </a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <div class="listar-data">
        {!! $dTitlesRows->render() !!}
    </div>

    <!--
    <h1>FILAS</h1>
    @foreach($dTitlesRows as $dTitlesRow)
        {{ $dTitlesRow->row_id }}
    @endforeach
        -->


@endsection

@include('admin.colections.complements.partials.alert-delete')

{!! Form::open(['route' => ['admin.colecciones.form.data.list.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

@section('scripts')
    <script src="{{ asset('/js/lists.js') }}"></script>
@endsection