<div class="panel panel-default">
    <div class="panel-body">
        your referal link is : <a href="/aff/{{ $user->affiliate->link }}">laundrycleanique.com/aff/{{ $user->affiliate->link }}</a> <br />
        clicked : {{ $user->affiliate->click }} <br>
        balance : {{ Helpers::reggo($user->affiliate->balance) }} <br>
        user registered : {{ $user->affiliate->storeCustomers()->count() }}
    </div>
</div>