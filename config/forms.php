<?php

return [
    /*
     * This will be returned by the `recipients()` helper for all forms in
     * non-production environments.
     */
    'development_recipients' => [
        ['email' => 'technical@spatie.be', 'name' => 'SPATIE Technical'],
    ],

    /*
     * Form types used by recipients.
     */
    'types' => [
        'contactForm' => 'Contact form',
    ],

];
