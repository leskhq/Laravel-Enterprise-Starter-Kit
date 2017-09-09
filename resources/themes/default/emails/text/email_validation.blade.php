Hello {{ $user->first_name }}

Only one more step to activate your account.

Click on the following link ({{ URL::to('auth/verify/' . $user->confirmation_code) }}) to validate your email address.

Thank you.

