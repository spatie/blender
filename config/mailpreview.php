<?php

return [
    /*
     * --------------------------------------------------------------------------
     * Generated previews path
     * --------------------------------------------------------------------------
     *
     * This option determines where all the generated email previews will be
     * stored for the application. Typically, this is within the storage
     * directory. However, you may change the location as you desire.
     *
     */

    'path' => storage_path('mail-previews'),

    /*
     * --------------------------------------------------------------------------
     * Time in seconds to keep old previews
     * --------------------------------------------------------------------------
     *
     * This option determines how long (in seconds) the mail transformer should
     * keep the generated preview files before deleting them. By default it
     * set to 60 seconds, but you can change this to whatever you desire.
     *
     */

    'maximum_lifetime' => 60 * 60 * 24,
];
