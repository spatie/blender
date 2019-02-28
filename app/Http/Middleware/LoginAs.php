<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Str;
use App\Services\Auth\Back\User as BackUser;
use App\Services\Auth\Front\User as FrontUser;
use Illuminate\Contracts\Auth\Authenticatable;

class LoginAs
{
    public function handle($request, Closure $next)
    {
        $segments = array_reverse(request()->segments());

        if (($segments[1] ?? '') !== 'login') {
            return $next($request);
        }

        if (! $this->canLoginAs()) {
            throw new Exception("You can't log in as a specific user right now");
        }

        return $this->loginAsAndRedirect($segments[0]);
    }

    protected function canLoginAs(): bool
    {
        // Just to be sure...

        if (! app()->environment('local')) {
            return false;
        }

        if (! Str::endsWith(request()->getHost(), '.dev')) {
            return false;
        }

        if (! in_array(env('DB_USERNAME'), ['homestead', 'root'])) {
            return false;
        }

        return true;
    }

    protected function loginAsAndRedirect(string $identifier)
    {
        $user = $this->getUser($identifier)->getAuthIdentifier();

        if (empty($user)) {
            throw new Exception('The user you\'re trying to log in as doesn\'t exist');
        }

        auth()->loginUsingId($user);

        return redirect()->to(
            str_replace("login/{$identifier}", '', request()->fullUrl())
        );
    }

    protected function getUser(string $identifier): Authenticatable
    {
        if (! Str::contains($identifier, '@')) {
            $identifier .= '@spatie.be';
        }

        if (request()->isBack()) {
            return BackUser::where(['email' => $identifier])->first();
        }

        return FrontUser::where(['email' => $identifier])->first();
    }
}
