@extends('layouts.dialog')

@section('content')

    <div class="container">

        <form class="form-signin" method="POST" action="/auth/password">
            {!! csrf_field() !!}

            <h2 class="form-signin-heading">Enter your email address</h2>

            <label for="email" class="sr-only">Email address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" required autofocus>

            <div class="btn-toolbar btn-group-lg" role="toolbar" style="margin-top: 10px;">
                <button class="btn btn-primary pull-left" type="submit">Reset password</button>
            </div>

        </form>

    </div> <!-- /container -->

@endsection

