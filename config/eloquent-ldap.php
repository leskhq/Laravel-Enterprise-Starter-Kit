<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Enabled
    |--------------------------------------------------------------------------
    |
    | The LDAP authentication method is disabled by default, to enabled it set
    | the variable 'LDAP_ENABLED' to true in your '.env' file.
    |
    */

    'enabled' => env('LDAP_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Automatically create new accounts on first login
    |--------------------------------------------------------------------------
    |
    | Should user accounts be automatically created, if they do not already
    | exists, after successful authentication against the configured
    | LDAP/AD server. This behaviour is set to true by default.
    |
    */

    'create_accounts' => env('LDAP_CREATE_ACCOUNTS', true),

    /*
    |--------------------------------------------------------------------------
    | Automatically replicate group membership
    |--------------------------------------------------------------------------
    |
    | Should a user's LDAP group membership be replicated in local group/roles?
    | If enabled the package will iterate through all LDAP groups that the
    | user is a member of and assigned membership of the local group with
    | the same name. This behaviour is set to true by default.
    | NOTE: New groups will not be created, membership will only be granted to
    | existing groups with the same name.
    |
    */

    'replicate_group_membership' => env('LDAP_REPLICATE_GROUP_MEMBERSHIP', true),

    /*
    |--------------------------------------------------------------------------
    | Automatically resync group membership on login
    |--------------------------------------------------------------------------
    |
    | Should a user's LDAP group membership be resynchronized on every login?
    | If enabled the package will resynchronized group membership on
    | every login.
    | NOTE: New groups will not be created, membership will only be granted to
    | existing groups with the same name.
    |
    */

    'resync_on_login' => env('LDAP_RESYNC_ON_LOGIN', true),

    /*
    |--------------------------------------------------------------------------
    | Group model
    |--------------------------------------------------------------------------
    |
    | Name of model that represents a group or role. This is the model that
    | will automatically be granted membership to based on the user's LDAP
    | membership if the option 'assign_group' is enabled.
    | NOTE: The user model is picked up from the 'model' variable in the
    | '\config\auth.php' configuration file.
    |
    */

    'group_model' => env('LDAP_GROUP_MODEL', App\Models\Group::class),

    /*
    |--------------------------------------------------------------------------
    | Internal label
    |--------------------------------------------------------------------------
    |
    | Value to use in the auth_type column for each user to mark them as
    | internal.
    | NOTE: To avoid errors, the package will consider both user with
    | an aut_type of this value and null or unset to be internal.
    |
    */

    'label_internal' => env('LDAP_LABEL_INTERNAL', 'internal'),

    /*
    |--------------------------------------------------------------------------
    | LDAP label
    |--------------------------------------------------------------------------
    |
    | Value to use in the auth_type column for each user to mark them as
    | originating from the LDAP server.
    |
    */

    'label_ldap' => env('LDAP_LABEL_LDAP', 'ldap'),

    /*
    |--------------------------------------------------------------------------
    | Account suffix
    |--------------------------------------------------------------------------
    |
    | Enter the right part of the email address, after and including the "@"
    | sign, configured in your domain. For Microsoft Active Directory this
    | can be your domain name, preceded by the "@" sign.
    |
    */

    'account_suffix' => env('LDAP_ACCOUNT_SUFFIX', "@company.com"),

    /*
    |--------------------------------------------------------------------------
    | Base DN
    |--------------------------------------------------------------------------
    |
    | Enter the LDAP/AD "Base DN" to bind to.
    |
    */

    'base_dn' => env('LDAP_BASE_DN', "DC=department,DC=company,DC=com"),

    /*
    |--------------------------------------------------------------------------
    | Server
    |--------------------------------------------------------------------------
    |
    | Enter the fully qualified hostname for your LDAP server or AD domain
    | controller.
    |
    */

    'server' => [ env('LDAP_SERVER', "ldapsrv01.company.com") ],

    /*
    |--------------------------------------------------------------------------
    | Port
    |--------------------------------------------------------------------------
    |
    | Enter the TCP port number to connect to your AD/LDAP server.
    |
    */

    'port' => env('LDAP_PORT', 389),

    /*
    |--------------------------------------------------------------------------
    | User name
    |--------------------------------------------------------------------------
    |
    | Enter the name of the user that will query the AD/LDAP server.
    |
    */

    'user_name' => env('LDAP_USER_NAME', "ldap_reader"),

    /*
    |--------------------------------------------------------------------------
    | Password
    |--------------------------------------------------------------------------
    |
    | Enter the password of the user that will query the AD/LDAP server.
    |
    */

    'password' => env('LDAP_PASSWORD', "PaSsWoRd"),

    /*
    |--------------------------------------------------------------------------
    | Return real primary group
    |--------------------------------------------------------------------------
    |
    | Fix Microsoft AD not following standards by not returning the real
    | primary group, may incur extra processing.
    |
    */

    'return_real_primary_group' => env('LDAP_RETURN_REAL_PRIMARY_GROUP', true),

    /*
    |--------------------------------------------------------------------------
    | Enable encryption?
    |--------------------------------------------------------------------------
    |
    | Enables the use of encryption to communicate with LDAP/AD using either
    | SSL or TLS.
    |
    | Supported values: false, "ssl", "tls"
    |
    */

    'secured' => env('LDAP_SECURED', false),

    /*
    |--------------------------------------------------------------------------
    | Secured port
    |--------------------------------------------------------------------------
    |
    | Enter the port number to use when using secured communications.
    |
    */

    'secured_port' => env('LDAP_SECURED_PORT', 636),

    /*
    |--------------------------------------------------------------------------
    | Resolve all group membership?
    |--------------------------------------------------------------------------
    |
    | Resolve group membership recursively. When disabled only groups that a
    | given user is a direct member of will be returned. May incur extra
    | processing.
    |
    */

    'recursive_groups' => env('LDAP_RECURSIVE_GROUPS', false),

    /*
    |--------------------------------------------------------------------------
    | Single sign-on
    |--------------------------------------------------------------------------
    |
    | Enable single sign-on.
    | NOTE: This feature is currently not supported
    |
    | TODO: Implement SSO!
    |
    */

    'sso' => env('LDAP_SSO', false),

    /*
    |--------------------------------------------------------------------------
    | User name field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user name.
    |
    */

    'username_field' => env('LDAP_USERNAME_FIELD', "samaccountname"),

    /*
    |--------------------------------------------------------------------------
    | Email field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's email address.
    |
    */

    'email_field' => env('LDAP_EMAIL_FIELD', "userprincipalname"),

    /*
    |--------------------------------------------------------------------------
    | First name field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's first name.
    |
    */

    'first_name_field' => env('LDAP_FIRST_NAME_FIELD', "givenname"),

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's last name.
    |
    */

    'last_name_field' => env('LDAP_LAST_NAME_FIELD', "sn"),

];

