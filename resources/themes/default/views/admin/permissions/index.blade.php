@extends('layouts.master')

@section('content')
    <p>
        {{ link_to_route('admin.permissions.create', 'New permissions') }}
    </p>
    <ul>
        @foreach($permissions as $permission)
            <li>
                {{$permission->name}}
                [{{link_to_route('admin.permissions.show', 'Show', [ 'id' => $permission->id])}} ]
                [{{link_to_route('admin.permissions.edit', 'Edit', [ 'id' => $permission->id])}} ]
            </li>
        @endforeach
    </ul>
@endsection

