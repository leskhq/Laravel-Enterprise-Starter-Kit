@extends('layouts.master')

@section('content')

	{{ $user->affiliate->storeCustomers->count() }} user registered by this affiliator:
	@foreach($user->affiliate->storeCustomers as $key => $value)
	<li>{{ $value->user->first_name .' '. $value->user->last_name }}</li>
	@endforeach

@endsection