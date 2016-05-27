<?php

namespace App\Services\Auth\Front;

use Laracasts\Presenter\Presenter;

/** @mixin \App\Services\Auth\Front\User */
class UserPresenter extends Presenter
{
    public function fullName():string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function avatar():string
    {
        return 'https://www.gravatar.com/avatar/'.md5($this->email).'?d=mm&s=256';
    }

    public function lastActivityDate():string
    {
        if ($this->last_activity === null || $this->last_activity->year == -1) {
            return fragment('back.frontUsers.neverLoggedIn');
        }

        $lastActivityDate = diff_date_for_humans($this->last_activity);

        if (str_contains($lastActivityDate, 'second')) {
            $lastActivityDate = fragment('back.frontUsers.justNow');
        }

        return $lastActivityDate;
    }
}
