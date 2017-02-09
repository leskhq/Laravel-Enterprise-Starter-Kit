@extends('layouts.master')

@section('content')

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Tambah Affiliator</h3>
				</div>
				<div class="box-body">
					{!! Form::open(['route' => 'admin.affiliate.store']) !!}

					<div class="form-group"> 	 
		                <label for="firstname"><span class="req">* </span> First name: </label>
	                    <input class="form-control" type="text" name="firstname" required /> 
                        <div id="errFirst"></div>    
		            </div>

		            <div class="form-group">
		                <label for="lastname"><span class="req">* </span> Last name: </label> 
	                    <input class="form-control" type="text" name="lastname" required />  
                        <div id="errLast"></div>
		            </div>

		            <div class="form-group">
		                <label for="email"><span class="req">* </span> Email Address: </label> 
		                    <input class="form-control" required type="text" name="email" id = "email"  onchange="email_validate(this.value);" />   
		                        <div class="status" id="status"></div>
		            </div>

		            <div class="form-group">
		                <label for="username"><span class="req">* </span> User name:  <small>This will be your login user name</small> </label> 
		                    <input class="form-control" type="text" name="username" id = "txt" placeholder="minimum 6 letters" required />  
		                        <div id="errLast"></div>
		            </div>

		            <div class="form-group">
		                <label for="password"><span class="req">* </span> Password: </label>
		                <input required name="password" type="password" class="form-control inputpass" minlength="4" maxlength="16"  id="pass1" />
		            </div>

					<div class="form-group">
		            	{!! Form::submit( trans('general.button.create'), ['class' => 'btn btn-primary'] ) !!}
		            	<a href="{!! route('admin.affiliate.dashboard') !!}" title="{{ trans('general.button.cancel') }}" class='btn btn-default'>{{ trans('general.button.cancel') }}</a>
		          	</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>

@endsection