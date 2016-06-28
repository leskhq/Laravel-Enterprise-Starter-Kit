@extends('layouts.dialog')

@section('content')
    <p class="login-box-msg">Enter your email address and new password</p>


    <form method="POST" action="/password/reset">
        {!! csrf_field() !!}
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group has-feedback">
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Password" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
            </div><!-- /.col -->
        </div>

    </form>

    {!! link_to_route('login', 'Sign in', [], ['class' => "text-center"]) !!}<br>
    {!! link_to_route('register', 'Register a new membership', [], ['class' => "text-center"]) !!}

@endsection