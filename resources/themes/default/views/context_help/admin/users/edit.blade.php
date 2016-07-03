@extends('layouts.context_help_area')

@section('help_header')
    <i class="fa fa-user"></i>
    <h3 class="box-title">Editing a user</h3>
@endsection


@section('help_content')
    <dl>
        <dt>First name</dt>
        <dd>First name of the user. A required field.</dd>
        <dt>Last name</dt>
        <dd>Last name of the user. A required field.</dd>
        <dt>User name</dt>
        <dd>User name of the user. A <u>required</u> field that must be <u>unique</u>.</dd>
        <dt>Email</dt>
        <dd>Email address of the user. A <u>required</u> field that must be <u>unique</u>.</dd>
        <dt>Password & Password confirmation</dt>
        <dd>Enter and confirm the new password. Leave empty to not change the current password.</dd>
        <dt>Type</dt>
        <dd>Information field, shows if the user is from an <u>internal</u> or <u>ldap</u> source.</dd>
        <dt>Roles</dt>
        <dd>To add a role first search for it then click on the <i class="fa fa-plus-square"></i> button.</dd>
        <dd><u>All</u> users will have the <u>Users</u> role.</dd>
        <dt>Permissions</dt>
        <dd>Although not recommended, allows the assignment of permissions to an individual user.</dd>
        <dd>Also shows the effective permissions of the user.</dd>
    </dl>
@endsection
