@extends('layouts.dialog')

@section('content')

    <div class="container">

        <form class="form-signin" method="POST" action="/auth/register">
            {!! csrf_field() !!}

            <h2 class="form-signin-heading">Enter your information</h2>

            <label for="first_name" class="sr-only">First name</label>
            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First name" value="{{ old('first_name') }}" required autofocus>

            <label for="last_name" class="sr-only">Last name</label>
            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last name" value="{{ old('last_name') }}" required>

            <label for="username" class="sr-only">User name</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="User name" value="{{ old('username') }}" required>

            <label for="email" class="sr-only">Email address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" required autofocus>

            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="" required>

            <label for="password_confirmation" class="sr-only">Confirm password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm password" value="" required>

            <div class="btn-toolbar btn-group-lg" role="toolbar" style="margin-top: 10px;">
                <button class="btn btn-primary pull-left" type="submit">Register</button>
            </div>

        </form>

    </div> <!-- /container -->

@endsection




