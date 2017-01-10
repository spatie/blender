<?php

namespace App\Services\MissingPageRedirector;

use App\Models\Redirect;
use Symfony\Component\HttpFoundation\Request;
use Spatie\MissingPageRedirector\Redirector\Redirector;

class DatabaseRedirector implements Redirector
{
    public function getRedirectsFor(Request $request): array
    {
        return Redirect::getAll()->flatMap(function ($redirect) {
            return [$redirect->old_url => $redirect->new_url];
        })->toArray();
    }
}

