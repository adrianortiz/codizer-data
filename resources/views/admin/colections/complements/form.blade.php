@extends('layout-admin')

@section('title', @trans('title.home'))

@section('content')

    <!-- REVISAR -->
    <div class="head-menu">
        <h1><span><img src="/images/icon-complements.svg"></span> <span> > </span> FORMULARIO: {{ $form->name  }}</h1>
        @include('admin.colections.complements.partials.menu')
    </div>

    {!! Form::open(['route' => ['admin.colecciones.form.data.store', $form], 'method' => 'GET']) !!}

        @if(count($inputs) === 0)
            <h1>Aun no tienes datos :( </h1>
        @else
            @foreach($inputs as $input)
                <div class="form-group">
                    <label for="{{ $input->title }}" title="{{ $input->title }}"> {{ $input->title }} </label>
                    {!! Form::text( $input->type_validation . '[]', old('content'), ['id' => $input->title, 'class' => 'form-control', 'title' => $input->title]) !!}
                    {!! Form::text( $input->type_validation . 'x[]', $input->id) !!}
                    {!! Form::text( $input->type_validation . 'y[]', $input->title) !!}

                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Guardar datos</button>
        @endif

     {!! Form::close() !!}


@endsection


@section('scripts')
    <script src="{{ asset('/js/form.js') }}"></script>
@endsection