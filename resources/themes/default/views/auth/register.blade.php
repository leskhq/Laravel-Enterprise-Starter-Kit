@extends('layouts.dialog')

@section('content')
    <p class="login-box-msg">Enter your information to register</p>
        <form class="form-signin" method="POST" action="{!! route('registerPost') !!}" >
            {!! csrf_field() !!}

            <div class="form-group has-feedback">
                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First name" value="{{ old('first_name') }}" required autofocus/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last name" value="{{ old('last_name') }}" required/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" id="username" name="username" class="form-control" placeholder="User name" value="{{ old('username') }}" required/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
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
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" id="remember" name="remember"> I agree to the <a href="{{URL::to('faust')}}">terms</a>
                        </label>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div><!-- /.col -->
            </div>
        </form>

        {!! link_to_route('login', 'Sign in', [], ['class' => "text-center"]) !!}<br>
        {!! link_to_route('recover_password', 'I forgot my password', [], ['class' => "text-center"]) !!}
@endsection
