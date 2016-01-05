<?php

namespace App\Http\ViewComposers\Shared;

use Illuminate\Contracts\View\View;
use Illuminate\Encryption\Encrypter;

class EncryptedCsrfTokenComposer
{
    public function compose(View $view)
    {
        $encryptedCsrfToken = app(Encrypter::class)->encrypt(csrf_token());

        $view->with(compact('encryptedCsrfToken'));
    }
}
