<?php

namespace App\Services\Auth;

trait UserPresenter
{
    public function getAvatarAttribute(): string
    {
        return 'https://www.gravatar.com/avatar/'.md5($this->email).'?d=mm&s=256';
    }

    public function getLastActivityDateAttribute(): string
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
