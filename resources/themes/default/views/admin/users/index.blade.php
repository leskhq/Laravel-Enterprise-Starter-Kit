@extends('layouts.master')

@section('content')
    <p>
        {{ link_to_route('admin.users.create', 'New user') }}
    </p>
    <ul>
        @foreach($users as $user)
            <li>
                {{$user->username}}
                [{{link_to_route('admin.users.show', 'Show', [ 'id' => $user->id])}} ]
                [{{link_to_route('admin.users.edit', 'Edit', [ 'id' => $user->id])}} ]
            </li>
        @endforeach
    </ul>
@endsection

