@extends('layouts.dialog')

@section('content')
    <p class="login-box-msg">Enter your email to reset your password</p>
        <form class="form-signin" method="POST" action="/auth/login" >
            {!! csrf_field() !!}

            <div class="form-group has-feedback">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Reset</button>
                </div><!-- /.col -->
            </div>
        </form>

        {!! link_to_route('login', 'Sign in', [], ['class' => "text-center"]) !!}<br>
        {!! link_to_route('register', 'Register a new membership', [], ['class' => "text-center"]) !!}

@endsection