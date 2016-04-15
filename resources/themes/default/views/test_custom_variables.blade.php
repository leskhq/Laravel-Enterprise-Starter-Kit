@extends('layouts.master')

@section('content')

  @foreach($data as $key => $value)
    <li>{{ $value->sale_id }}</li>
  @endforeach

@endsection
