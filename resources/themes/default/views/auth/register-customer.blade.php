@extends('layouts.store')

@section('top_styles')
	fieldset {
	    border: thin solid #ccc; 
	    border-radius: 4px;
	    padding: 20px;
	    padding-left: 40px;
	    background: #fbfbfb;
	}
	legend {
	   color: #678;
	}
	.form-control {
	    width: 95%;
	}
	label small {
	    color: #678 !important;
	}
	span.req {
	    color:maroon;
	    font-size: 112%;
	}
@endsection

@section('content')

	<!-- catg header banner section -->
	@include('partials.store_banner')
	<!-- / catg header banner section -->

	<!-- Cart view section -->
	<section id="cart-view">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="cart-view-area">
						<div class="cart-view-table">
							<div class="col-md-10 col-md-offset-1">
								{!! Form::open(['url' => '/postDaftar', 'method' => 'POST']) !!}
								{!! Form::hidden('aff_link', session()->get('aff_link')) !!}
								<fieldset><legend class="text-center">Valid information is required to register. <span class="req"><small> required *</small></span></legend>

					            <div class="form-group"> 	 
					                <label for="firstname"><span class="req">* </span> First name: </label>
				                    <input class="form-control" type="text" name="firstname" id = "txt" onkeyup = "Validate(this)" required /> 
			                        <div id="errFirst"></div>    
					            </div>

					            <div class="form-group">
					                <label for="lastname"><span class="req">* </span> Last name: </label> 
				                    <input class="form-control" type="text" name="lastname" id = "txt" onkeyup = "Validate(this)" placeholder="hyphen or single quote OK" required />  
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
					                    <input required name="password" type="password" class="form-control inputpass" minlength="4" maxlength="16"  id="pass1" /> </p>

					                <label for="password"><span class="req">* </span> Password Confirm: </label>
					                    <input required name="password" type="password" class="form-control inputpass" minlength="4" maxlength="16" placeholder="Enter again to validate"  id="pass2" onkeyup="checkPass(); return false;" />
					                        <span id="confirmMessage" class="confirmMessage"></span>
					            </div>

					            <div class="form-group">
					                <input type="checkbox" required name="terms" onchange="this.setCustomValidity(validity.valueMissing ? 'Please indicate that you accept the Terms and Conditions' : '');" id="field_terms">   <label for="terms">I agree with the <a href="terms.php" title="You may read our terms and conditions by clicking on this link">terms and conditions</a> for Registration.</label><span class="req">* </span>
					            </div>

					            <div class="form-group">
					                <input class="btn btn-success" type="submit" name="submit_reg" value="Register">
					            </div>
		                     	<h5>You will receive an email to complete the registration and validation process. </h5>
					            <h5>Be sure to check your spam folders. </h5>
					 
					            </fieldset>
								{!! Form::close() !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- / Cart view section -->

@endsection

@section('bottom_scripts')
<script>
	function checkPass()
	{
	    //Store the password field objects into variables ...
	    var pass1 = document.getElementById('pass1');
	    var pass2 = document.getElementById('pass2');
	    //Store the Confimation Message Object ...
	    var message = document.getElementById('confirmMessage');
	    //Set the colors we will be using ...
	    var goodColor = "#66cc66";
	    var badColor = "#ff6666";
	    //Compare the values in the password field 
	    //and the confirmation field
	    if(pass1.value == pass2.value){
	        //The passwords match. 
	        //Set the color to the good color and inform
	        //the user that they have entered the correct password 
	        pass2.style.backgroundColor = goodColor;
	        message.style.color = goodColor;
	        message.innerHTML = "Passwords Match"
	    }else{
	        //The passwords do not match.
	        //Set the color to the bad color and
	        //notify the user.
	        pass2.style.backgroundColor = badColor;
	        message.style.color = badColor;
	        message.innerHTML = "Passwords Do Not Match!"
	    }
	}
	// validates text only
	function Validate(txt) {
	    txt.value = txt.value.replace(/[^a-zA-Z-'\n\r.]+/g, '');
	}
	// validate email
	function email_validate(email)
	{
	var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

	    if(regMail.test(email) == false)
	    {
	    document.getElementById("status").innerHTML    = "<span class='warning'>Email address is not valid yet.</span>";
	    }
	    else
	    {
	    document.getElementById("status").innerHTML	= "<span class='valid'>Thanks, you have entered a valid Email address!</span>";	
	    }
	}
</script>
@endsection