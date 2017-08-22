<?php

return [

    /*
     * This is the master switch to enable demo mode.
     */
    'enabled' => env('DEMO_MODE_ENABLED', false),

    /*
     * Visitors that go an url that is protected by demo mode will be redirected.
     * to this url.
     */
    'redirect_unauthorized_users_to_url' => '/coming-soon',

    /*
     * After have been granted access visitors will be redirected to this url.
     */
    'redirect_authorized_users_to_url' => '/',

];
