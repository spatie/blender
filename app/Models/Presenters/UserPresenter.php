<?php

namespace App\Models\Presenters;

use App\Models\Enums\UserStatus;
use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    /**
     * Return the full name of a user.
     *
     * @return string
     */
    public function fullName()
    {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * Get the gravatar of this user.
     *
     * @return string
     */
    public function avatar()
    {
        return 'https://www.gravatar.com/avatar/'.md5($this->email).'?d=mm&s=256';
    }

    /**
     * Get a human readable last activity date.
     *
     * @return string
     */
    public function lastActivityDate()
    {
        if ($this->last_activity === null || $this->last_activity->year == -1) {
            return trans('back-users.neverLoggedIn');
        }

        $lastActivityDate = diff_date_for_humans($this->last_activity);

        if (str_contains($lastActivityDate, 'second')) {
            $lastActivityDate = trans('back-users.justNow');
        }

        return $lastActivityDate;
    }

    /**
     * Get the status of this user.
     *
     * @return string
     */
    public function status()
    {
        if ($this->entity->status == UserStatus::ACTIVE) {
            return 'Actief';
        }

        if ($this->entity->status == UserStatus::WAITING_FOR_APPROVAL) {
            return 'Wacht op goedkeuring';
        }
    }

    /**
     * Get the role of this user.
     *
     * @return string
     */
    public function role()
    {
        return trans("back-users.role.{$this->entity->role}.singular");
    }
}
