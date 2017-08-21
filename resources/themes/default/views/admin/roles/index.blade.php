@extends('layouts.master')

@section('content')
    <p>
        {{ link_to_route('admin.roles.create', 'New roles') }}
    </p>
    <ul>
        @foreach($roles as $role)
            <li>
                {{$role->name}}
                [{{link_to_route('admin.roles.show', 'Show', [ 'id' => $role->id])}} ]
                [{{link_to_route('admin.roles.edit', 'Edit', [ 'id' => $role->id])}} ]
            </li>
        @endforeach
    </ul>
@endsection

