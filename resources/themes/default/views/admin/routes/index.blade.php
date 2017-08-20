@extends('layouts.master')

@section('content')
    <p>
        {{ link_to_route('admin.routes.create', 'New route') }}
    </p>
    <ul>
        @foreach($routes as $route)
            <li>
                {{$route->name}}
                [{{link_to_route('admin.routes.show', 'Show', [ 'id' => $route->id])}} ]
                [{{link_to_route('admin.routes.edit', 'Edit', [ 'id' => $route->id])}} ]
            </li>
        @endforeach
    </ul>
@endsection

