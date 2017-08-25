@extends('layouts.master')

@section('content')
    <p>
        @permission('core.users.create')
            {{ link_to_route('admin.users.create', 'New user') }}
        @else
            [New User]
        @endpermission
    </p>
    <ul>
        @foreach($users as $user)
            <li>
                {{$user->username}}
                @permission('core.users.read')
                    [{{link_to_route('admin.users.show', 'Show', [ 'id' => $user->id])}} ]
                @else
                    [Show]
                @endpermission
                @permission('core.users.create')
                    [{{link_to_route('admin.users.edit', 'Edit', [ 'id' => $user->id])}} ]
                @else
                    [Edit]
                @endpermission
            </li>
        @endforeach
    </ul>
@endsection

