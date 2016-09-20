@extends('layouts.dialog')

@section('content')
    <p class="login-box-msg">Enter the token that you received or click on the link provided in the email.</p>
        <form class="form-signin" method="POST" action="{{ route('confirm_emailPost') }}" >
            {!! csrf_field() !!}

            <div class="form-group has-feedback">
                <input type="text" id="token" name="token" class="form-control" placeholder="Token" required autofocus/>
                <span class="glyphicon glyphicon-key form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Verify</button>
                </div><!-- /.col -->
            </div>
        </form>
@endsection