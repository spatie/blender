<?php

namespace App\Services\Auth\Front;

use Laracasts\Presenter\Presenter;

/** @mixin \App\Services\Auth\Front\User */
class UserPresenter extends Presenter
{
    public function fullName() : string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function lastActivityDate() : string
    {
        if ($this->last_activity === null || $this->last_activity->year == -1) {
            return trans('back-frontUsers.neverLoggedIn');
        }

        $lastActivityDate = diff_date_for_humans($this->last_activity);

        if (str_contains($lastActivityDate, 'second')) {
            $lastActivityDate = trans('back-frontUsers.justNow');
        }

        return $lastActivityDate;
    }
}
