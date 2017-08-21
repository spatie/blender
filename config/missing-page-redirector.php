<?php

return [
    /*
     * This is the class responsible for providing the URLs which must be redirected.
     * The only requirement for the redirector is that it needs to implement the
     * `Spatie\MissingPageRedirector\Redirector\Redirector`-interface
     */
    'redirector' => \App\Services\MissingPageRedirector\DatabaseRedirector::class,

    /*
     * When using the `ConfigurationRedirector` you can specify the redirects in this array.
     * You can use Laravel's route parameters here.
     */
    'redirects' => [
//        '/non-existing-page' => '/existing-page',
//        '/old-blog/{url}' => '/new-blog/{url}',
    ],

];
