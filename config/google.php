<?php

return [
    'application_name' => env('GOOGLE_APPLICATION_NAME', 'My Laravel Application'),
    'client_id'        => env('GOOGLE_CLIENT_ID', '277562078012-re7kvpi635ipith48c3tdn1cgqq0d89s.apps.googleusercontent.com'),
    'client_secret'    => env('GOOGLE_CLIENT_SECRET', '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'),
    'redirect_uri'     => env('GOOGLE_REDIRECT_URL', 'http://localhost:8000/login/google/callback'),
    'scopes'           => [
        \Google\Service\Sheets::DRIVE,
        \Google\Service\Sheets::SPREADSHEETS,
    ],
    'access_type'      => 'offline',
    'approval_prompt'  => 'force',
    'developer_key'    => env('GOOGLE_API_KEY', 'AIzaSyAWe03w3wXPzHQaScngVPlJfsjBLnlagYI'),
    'service'          => [
        'enable' => true,
        'file'   => env('GOOGLE_SERVICE_ACCOUNT_JSON', storage_path('google/romio-425203-65f3bf347bf7')),
        // 'file' => storage_path('app/google_credentials/romio-425203-65f3bf347bf7.json'), // Update this path

    ],
    'config'           => [],
    // 'post_spreadsheet_id' and 'post_sheet_id' are not standard keys and should be added only if used in your application.
    // 'post_spreadsheet_id' => env('POST_SPREADSHEET_ID'),
    // 'post_sheet_id'       => env('POST_SHEET_ID'),
];
