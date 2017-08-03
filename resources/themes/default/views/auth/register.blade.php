@extends('layouts.dialog')

@section('content')
    <p class="login-box-msg">Enter your information to register</p>
    <form class="form-signin" method="POST" action="{!! route('register') !!}" >
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }} has-feedback">
            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First name" value="{{ old('first_name') }}" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('first_name'))
                <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }} has-feedback">
            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last name" value="{{ old('last_name') }}" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('last_name'))
                <span class="help-block">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }} has-feedback">
            <input type="text" id="username" name="username" class="form-control" placeholder="username" value="{{ old('username') }}" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('username'))
                <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} has-feedback">
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm password" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
            @endif
        </div>

        <div class="row">
            <div class="col-xs-8">
                <div class="form-group{{ $errors->has('terms') ? ' has-error' : '' }} has-feedback">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" id="terms" name="terms"> I agree to the <a href="{{URL::to('faust')}}">terms</a>
                        </label>
                    </div>
                    @if ($errors->has('terms'))
                        <span class="help-block">
                            <strong>{{ $errors->first('terms') }}</strong>
                        </span>
                    @endif
                </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
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
    <div class="row">
        <div class="col-xs-6">
            <a class="btn btn-link" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
        </div>
    </div>

@endsection
