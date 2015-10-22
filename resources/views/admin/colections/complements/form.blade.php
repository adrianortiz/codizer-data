@extends('layout-admin')

@section('title', @trans('title.home'))

@section('content')

    <!-- REVISAR -->
    <div class="head-menu">
        <h1><span><img src="/images/icon-complements.svg"></span> <span> > </span> FORMULARIO: {{ $form->name  }}</h1>
        @include('admin.colections.complements.partials.menu')
    </div>

    <form class="form-horizontal" role="form" method="POST" action="{{ route('form') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @if(count($inputs) === 0)
            <h1>Aun no tienes datos :( </h1>
        @else
            @foreach($inputs as $input)
                <div class="form-group">
                    <label for="content"> {{ $input->title }} </label>
                    {!! Form::text('content', old('content'), ['id' => 'content', 'class' => 'form-control']) !!}
                </div>
            @endforeach
        @endif
    </form>


@endsection


@section('scripts')
    <!-- <script src="{{ asset('/js/inputs.js') }}"></script> -->
@endsection