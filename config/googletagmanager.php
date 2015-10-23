<?php

return [

    /*
     * The Google Tag Manager id, should be a code that looks something like "gtm-xxxx"
     */
    'id' =>  env('GOOGLE_TAG_MANAGER_ID'),

    /*
     * Enable or disable script rendering. Useful for local development.
     */
    'enabled' => env('GOOGLE_TAG_MANAGER_ENABLED', false),

    /*
     * If you want to use some macro's you 'll probably store them
     * in a dedicated file. You can optionally define the path
     * to that file here and we will load it for you.
     */
    'macroPath' => app_path('Support/GoogleTagManager/Macros.php'),

];
