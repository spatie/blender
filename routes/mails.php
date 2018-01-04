<?php

use App\Mail\Admin\ContactFormSubmitted;
use App\Models\FormResponse;

Route::get('/admin/contactFormSubmitted', function () {
    $formResponse = new FormResponse([
        'name' => 'Spatie',
        'telephone' => '032925679',
        'email' => 'info@spatie',
        'address' => 'Samberstraat 69D',
        'postal' => '2060',
        'city' => 'Antwerpen',
        'remarks' => 'Open source software is used in all projects we deliver. Laravel, Nginx, Ubuntu are just a few of the free pieces of software we use every single day. For this, we are very grateful.',
    ]);

    return new ContactFormSubmitted($formResponse);
});
