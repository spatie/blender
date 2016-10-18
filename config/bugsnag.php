<?php

return [
    'api_key' => env('BUGSNAG_API_KEY_PHP'),
    'api_key_js' => env('BUGSNAG_API_KEY_JS'),
    'notify_release_stages' => ['production'],
];
