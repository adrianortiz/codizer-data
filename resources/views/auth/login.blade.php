@extends('layout-login')

@section('title', @trans('title.login'))

@section('content')



    @include('partials/errors')

    <div id="login-container">
        <div class="login-left">

        </div>
        <div class="login-right">



                        <form method="POST" action="{{ route('login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group txt-center">
                                <label>@lang('auth.login_title')</label>
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
                                <button type="submit" class="btn btn-primary">
                                    @lang('auth.login_button')
                                </button>
                                <label class="txt-right">
                                    <input type="checkbox" name="remember"> @lang('auth.remember')
                                </label>
                            </div>


                            <div class="form-group">
                                <a href="/password/email">@lang('auth.forgot_link')</a>
                            </div>




                        </form>
        </div>
    </div>
@endsection