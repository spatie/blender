<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Also log to Laravel's default log handler
    |--------------------------------------------------------------------------
    |
    | If "alsoLogInDefaultLog" the activity will also be logged in the default
    | Laravel logger handler
    |
    */
    'alsoLogInDefaultLog'        => true,


    /*
    |--------------------------------------------------------------------------
    | Max age in months for log records
    |--------------------------------------------------------------------------
    |
    | When running the cleanLog-command all recorder older than the number of months
    | specified here will be deleted
    |
    */
        'deleteRecordsOlderThanMonths'        => 2,
    ];