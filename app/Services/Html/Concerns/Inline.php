<?php

namespace App\Services\Html\Concerns;

use App\Services\Auth\User;
use Spatie\Html\Elements\A;
use Spatie\Html\Elements\Form;
use Spatie\Html\Elements\Span;

trait Inline
{
    public function icon(string $icon): Span
    {
        return $this->span()->class("fa fa-{$icon}");
    }

    public function avatar(User $user): Span
    {
        return $this->span()
            ->class('avatar')
            ->attribute('style', "background-image: url('{$user->avatar}')");
    }

    public function onlineIndicator(bool $online): Span
    {
        return $this->span()
            ->html(
                $this->icon($online ? 'circle' : 'circle-o')->class($online ? 'on' : 'off')
            )
            ->attribute('title', $online ? 'Online' : 'Offline')
            ->class(['status', $online ? '-on' : '-off']);
    }

    public function backToIndex(string $action, array $parameters = []): A
    {
        return $this->a(
            action($action, $parameters),
            'Return to index'
        )->class('breadcrumb--back');
    }

    public function deleteButton(string $action): Form
    {
        return $this->form('DELETE', $action)
            ->attribute('data-confirm', 'true')
            ->child(
                $this->button()
                    ->type('submit')
                    ->html($this->icon('trash'))
                    ->class('button -danger -small')
            );
    }
}
