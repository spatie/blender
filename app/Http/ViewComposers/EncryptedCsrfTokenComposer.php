<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class EncryptedCsrfTokenComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encryptedCsrfToken = $encrypter->encrypt(csrf_token());

        $view->with(compact('encryptedCsrfToken'));
    }
}
