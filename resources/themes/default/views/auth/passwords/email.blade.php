@extends('layouts.dialog')

@section('content')
    <p class="login-box-msg">Enter your email to reset your password</p>
        <form class="form-signin" method="POST" action="{{ route('password.email') }}" >
            {!! csrf_field() !!}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Reset</button>
                </div><!-- /.col -->
            </div>
        </form>

        <div class="row">
            <div class="col-xs-6">
                <a class="btn btn-link" href="{{ route('login') }}">
                    Login
                </a>
            </div>
        </div>
         @if (Settings::get('app.allow_registration'))
            <div class="row">
                <div class="col-xs-6">
                    <a class="btn btn-link" href="{{ route('register') }}">
                        Register a new membership
                    </a>
                </div>
            </div>
         @endif

@endsection