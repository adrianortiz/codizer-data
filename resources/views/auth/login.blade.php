@extends('layout')

@section('title', @trans('title.login'))

@section('msn-boton')
    <p>¿Aun sin cuenta? Registrate</p>
    <a href="{{ route('register') }}" class="btn btn-login">@lang('auth.register_button')</a>
@endsection

@section('content')
<div id="container-panel-right">


    @include('partials/errors')

    <div id="login-container">
        <div class="login-left">



        </div>
        <div class="login-right">



                        <form method="POST" action="{{ route('login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group txt-center">
                                <h1>@lang('auth.login_title')</h1>
                            </div>

                            <div class="form-group">
                                <label for="email">@lang('validation.attributes.email')</label>
                                {!! Form::text('email', null, ['id' => 'email', 'class' => 'form-control', 'type' => 'email']) !!}
                            </div>

                            <div class="form-group">
                                <label for="password">@lang('validation.attributes.password')</label>
                                {!! Form::password('password', ['id' => 'password', 'class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> @lang('auth.remember')
                                    </label>
                                </div>
                            </div>
                            <!--
                                <input type="checkbox" name="remember" class="checkbox">
                                <div class="switch"></div>
                                -->

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    @lang('auth.login_button')
                                </button>
                            </div>

                        </form>
        </div>
    </div>
</div>



@endsection