@extends('layouts.dialog')

@section('content')
    <p class="login-box-msg">Sign in to start your session</p>
        <form class="form-signin" method="POST" action="{!! route('login') !!}" >
            {!! csrf_field() !!}

            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }} has-feedback">
                <input type="text" id="username" name="username" class="form-control" placeholder="User name" value="{{ old('username') }}" required autofocus/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }} has-feedback">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row">
                 @if ( Settings::get('auth.enable_remember_token') )
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" id="remember" name="remember"> Remember Me
                            </label>
                        </div>
                    </div><!-- /.col -->
                 @endif
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div><!-- /.col -->
            </div>
        </form>

        <div class="row">
            <div class="col-xs-6">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    Forgot Your Password?
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