<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Authentication Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the authentication driver that will be utilized.
    | This driver manages the retrieval and authentication of the users
    | attempting to get access to protected areas of your application.
    |
    | Supported: "database", "eloquent"
    |
    */

    'driver' => 'eloquent-ldap',

    /*
    |--------------------------------------------------------------------------
    | Authentication Model
    |--------------------------------------------------------------------------
    |
    | When using the "Eloquent" authentication driver, we need to know which
    | Eloquent model should be used to retrieve your users. Of course, it
    | is often just the "User" model but you may use whatever you like.
    |
    */

    'model' => App\User::class,

    /*
    |--------------------------------------------------------------------------
    | Authentication Table
    |--------------------------------------------------------------------------
    |
    | When using the "Database" authentication driver, we need to know which
    | table should be used to retrieve your users. We have chosen a basic
    | default value but you may easily change it to any table you like.
    |
    */

    'table' => 'users',

    /*
    |--------------------------------------------------------------------------
    | Password Reset Settings
    |--------------------------------------------------------------------------
    |
    | Here you may set the options for resetting passwords including the view
    | that is your password reset e-mail. You can also set the name of the
    | table that maintains all of the reset tokens for your application.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'password' => [
        'email' => 'emails.html.password_reset',
        'table' => 'password_resets',
        'expire' => 60,
    ],


    /*
    |--------------------------------------------------------------------------
    | Default account status
    |--------------------------------------------------------------------------
    |
    | Specify if accounts are enabled as they are created when registering or
    | if they are disabled, and waiting for an user administrator to manually
    | enable them.
    |
    */
    'enable_user_on_create' => env('auth.enable_user_on_create', true),


    /*
    |--------------------------------------------------------------------------
    | Email validation
    |--------------------------------------------------------------------------
    |
    | Should the system send an email to a user, after the registration form is
    | submitted, with a validation link.
    |
    */
    'email_validation' => env('auth.email_validation', false),


    /*
    |--------------------------------------------------------------------------
    | Enable user on validation
    |--------------------------------------------------------------------------
    |
    | Should the system automatically enable users if they pass the email
    | validation test?
    |
    */
    'enable_user_on_validation' => env('auth.enable_user_on_validation', false),


    /*
    |--------------------------------------------------------------------------
    | Enable remember token
    |--------------------------------------------------------------------------
    |
    | Should the system allow a user to set the remember token ?
    |
    */
    'enable_remember_token' => env('auth.enable_remember_token', true),

];
