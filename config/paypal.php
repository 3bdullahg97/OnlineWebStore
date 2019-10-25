<?php

return [
    'sandbox'  => [
        'client_id' => env('PAYPAL_SANDBOX_CLIENT_ID'),
        'secret' => env('PAYPAL_SANDBOX_SECRET'),
    ],
    'live' => [
        'client_id' => env('PAYPAL_LIVE_CLIENT_ID'),
        'secret' => env('PAYPAL_LIVE_SECRET')
    ],
    'settings' => [
        'mode' => env('PAYPAL_MODE', 'sandbox'),
        'http.ConnectionTimeOut' => 3000000,
        'log' => [
            'LogEnabled' => true,
            'FileName'   => storage_path() . '/logs/paypal.log',
            //DEBUG, INFO, WARN, ERROR
            'LogLevel'   => 'DEBUG'
        ]
    ]
];
