Hi {{ $user->first_name }},<br>
<br>
We got a request to reset your password.<br>
If you made the request, click <a href="{{ url('password/reset/'.$token) }}">here</a> to reset your password.<br>
<br>
If you didn't want to change your password, you can ignore this email. Your password won't change.<br>
<br>
Thank you.<br>

