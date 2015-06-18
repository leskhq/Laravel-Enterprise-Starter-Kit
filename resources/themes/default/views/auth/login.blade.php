@extends('layouts.dialog')

@section('content')

    <div class="container">

        <form class="form-signin" method="POST" action="/auth/login">
            {!! csrf_field() !!}

            <h2 class="form-signin-heading">Please sign in</h2>

            <label for="username" class="sr-only">User name</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="User name" value="{{ old('username') }}" required autofocus>

            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>

            <div class="checkbox">
                <label>
                    <input type="checkbox" id="remember" name="remember"> Remember me
                </label>
            </div>

            <div class="btn-toolbar btn-group-lg" role="toolbar" style="margin-top: 10px;">
                <button class="btn btn-primary pull-left" type="submit">Sign in</button>
                {!! link_to_route('recover_password', 'Reset password', [], ['class' => "btn btn-warning pull-right"]) !!}
            </div>

        </form>

    </div> <!-- /container -->

@endsection




