@extends('layouts.master')

@section('content')
    <h1>TEST HOME!</h1>
    <div class="box-body">
        <a href="{{ route('test_flash_success') }}" class="btn btn-success"><i class="fa fa-check">  </i> Success flash</a>
        <a href="{{ route('test_flash_info') }}"    class="btn btn-info"><i class="fa fa-info">   </i> Info flash</a>
        <a href="{{ route('test_flash_warning') }}" class="btn btn-warning"><i class="fa fa-warning"></i> Warning flash</a>
        <a href="{{ route('test_flash_error') }}"   class="btn btn-danger"><i class="fa fa-ban">    </i> Error flash</a>
    </div>
@endsection
