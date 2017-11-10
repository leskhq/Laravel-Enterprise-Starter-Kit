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

    'enabled' => env('eloquent-ldap.enabled', false),

    /*
    |--------------------------------------------------------------------------
    | Debug
    |--------------------------------------------------------------------------
    |
    | Enables a higher debug level for the underlying LDAP library. Useful when
    | combined with a packet sniffer to debug connectivity issues.
    |
    */

    'debug' => env('eloquent-ldap.debug', 'false'),

    /*
    |--------------------------------------------------------------------------
    | Server type
    |--------------------------------------------------------------------------
    |
    | The server type either 'LDAP' for Lightweight Directory Access Protocol
    | servers, or MSAD for Microsoft Active Directory servers.
    |
    */

    'server_type' => env('eloquent-ldap.server_type', 'MSAD'),

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

    'create_accounts' => env('eloquent-ldap.create_accounts', true),

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

    'replicate_group_membership' => env('eloquent-ldap.replicate_group_membership', true),

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

    'resync_on_login' => env('eloquent-ldap.resync_on_login', true),

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

    'group_model' => env('eloquent-ldap.group_model', App\Models\Group::class),

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

    'label_internal' => env('eloquent-ldap.label_internal', 'internal'),

    /*
    |--------------------------------------------------------------------------
    | LDAP label
    |--------------------------------------------------------------------------
    |
    | Value to use in the auth_type column for each user to mark them as
    | originating from the LDAP server.
    |
    */

    'label_ldap' => env('eloquent-ldap.label_ldap', 'ldap'),

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

    'account_suffix' => env('eloquent-ldap.account_suffix', "@company.com"),

    /*
    |--------------------------------------------------------------------------
    | Base DN
    |--------------------------------------------------------------------------
    |
    | Enter the LDAP/AD "Base DN" to bind to.
    |
    */

    'base_dn' => env('eloquent-ldap.base_dn', "DC=department,DC=company,DC=com"),

    /*
    |--------------------------------------------------------------------------
    | Server
    |--------------------------------------------------------------------------
    |
    | Enter the fully qualified hostname for your LDAP server or AD domain
    | controller.
    |
    */

    'server' => [ env('eloquent-ldap.server', "ldapsrv01.company.com") ],

    /*
    |--------------------------------------------------------------------------
    | Port
    |--------------------------------------------------------------------------
    |
    | Enter the TCP port number to connect to your AD/LDAP server.
    |
    */

    'port' => env('eloquent-ldap.port', 389),

    /*
    |--------------------------------------------------------------------------
    | User name
    |--------------------------------------------------------------------------
    |
    | Enter the name of the user that will query the AD/LDAP server.
    |
    */

    'user_name' => env('eloquent-ldap.user_name', "ldap_reader"),

    /*
    |--------------------------------------------------------------------------
    | Password
    |--------------------------------------------------------------------------
    |
    | Enter the password of the user that will query the AD/LDAP server.
    |
    */

    'password' => env('eloquent-ldap.password', "PaSsWoRd"),

    /*
    |--------------------------------------------------------------------------
    | Return real primary group
    |--------------------------------------------------------------------------
    |
    | Fix Microsoft AD not following standards by not returning the real
    | primary group, may incur extra processing.
    |
    */

    'return_real_primary_group' => env('eloquent-ldap.return_real_primary_group', true),

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

    'secured' => env('eloquent-ldap.secured', false),

    /*
    |--------------------------------------------------------------------------
    | Secured port
    |--------------------------------------------------------------------------
    |
    | Enter the port number to use when using secured communications.
    |
    */

    'secured_port' => env('eloquent-ldap.secured_port', 636),

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

    'recursive_groups' => env('eloquent-ldap.recursive_groups', false),

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

    'sso' => env('eloquent-ldap.sso', false),

    /*
    |--------------------------------------------------------------------------
    | User name field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user name.
    |
    */

    'username_field' => env('eloquent-ldap.username_field', "samaccountname"),

    /*
    |--------------------------------------------------------------------------
    | Email field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's email address.
    |
    */

    'email_field' => env('eloquent-ldap.email_field', "userprincipalname"),

    /*
    |--------------------------------------------------------------------------
    | First name field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's first name.
    |
    */

    'first_name_field' => env('eloquent-ldap.first_name_field', "givenname"),

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's last name.
    |
    */

    'last_name_field' => env('eloquent-ldap.last_name_field', "sn"),


    /*
    |--------------------------------------------------------------------------
    | User query filter
    |--------------------------------------------------------------------------
    |
    | Enter the LDAP filter or query string to search for users.
    |
    | TIP: Use the command line `ldapsearch` to help you build and test your
    | query string.
    |
    | NOTE: The variable `%username` must be used and will be replaced by the
    | correct value when executed.
    |
    */

    'user_filter' => env('eloquent-ldap.user_filter', "(&(objectcategory=person)(samaccountname=%username))"),


];

