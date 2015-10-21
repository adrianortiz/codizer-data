@extends('layout')

@section('title', 'Registrate')

@section('msn-boton')
    <p>Si ya tienes una cuenta inicia sesión</p>
    <a href="{{ route('login') }}" class="btn btn-login">Iniciar sesión</a>
@endsection

@section('content')
<div id="container-panel-right">

    @include('partials/errors')

    <div id="container-form-register">

        <h1>@lang('auth.register_title')</h1>

        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="name">@lang('validation.attributes.name')</label>
                {!! Form::text('name', old('name'), ['id' => 'name', 'class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <label for="email">@lang('validation.attributes.email')</label>
                {!! Form::email('email', old('email'), ['id' => 'email', 'class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <label for="password">@lang('validation.attributes.password')</label>
                {!! Form::password('password', ['id' => 'password', 'class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <label for="password_confirmation">@lang('validation.attributes.password_confirmation')</label>
                {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    @lang('auth.register_button')
                </button>
            </div>
        </form>
    </div>
</div>

@endsection