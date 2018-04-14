<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Snaptier Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like. Note that the 3 supported authentication methods are:
    | "none", "oauth" and "password".
    |
    */

    'connections' => [

        'main' => [
            'token'   => 'your-token',
            'method'  => 'oauth',
            // 'backoff' => false,
            // 'cache'   => false,
            // 'url'     => null,
        ],

        'alternative' => [
            'username' => 'foo',
            'password' => 'bar',
            'method'   => 'password',
            // 'backoff'  => false,
            // 'cache'    => false,
            // 'url'      => null,
        ],

    ],

];
