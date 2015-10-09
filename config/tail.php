<?php

return [

    'connections' => [

        'production' => [
            'host'          => env('TAIL_HOST'),
            'user'          => env('TAIL_USER'),
            'logDirectory'  => env('TAIL_LOG_DIRECTORY'),
        ],

    ],
];