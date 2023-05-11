<?php

return [

    'credentials' => [
        'client_Id' => env('AUTH0_MGMT_CLIENT_ID'),
        'client_secret' => env('AUTH0_MGMT_CLIENT_SECRET'),
    ],
    'domain' => env('AUTH0_MGMT_DOMAIN'),
    'audience' => env('AUTH0_MGMT_AUDIENCE'),
    'version' => 'v2'


];