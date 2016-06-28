<h1>Your password was changed!</h1>

Hi {{ $user->first_name }},<br>
This is just a quick note to inform you that your password was changed.<br>
<br>
If you did not request to change your password, your account may have been compromised<br>
and you should go to the <a href="{{ route('recover_password') }}">Recover password</a> page to reset it.<br>
<br>
Thank you.<br>

