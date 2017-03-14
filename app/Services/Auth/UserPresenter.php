<?php

namespace App\Services\Auth;

trait UserPresenter
{
    public function getFullNameAttribute(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getAvatarAttribute(): string
    {
        return 'https://www.gravatar.com/avatar/'.md5($this->email).'?d=mm&s=256';
    }

    public function getLastActivityDateAttribute(): string
    {
        if ($this->last_activity === null || $this->last_activity->year == -1) {
            return __('back.users.neverLoggedIn');
        }

        $lastActivityDate = diff_date_for_humans($this->last_activity);

        if (str_contains($lastActivityDate, 'second')) {
            $lastActivityDate = __('back.users.justNow');
        }

        return $lastActivityDate;
    }
}
