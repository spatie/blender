<?php

namespace App\Services\Html;

use App\Services\Auth\User;
use Collective\Html\HtmlBuilder as BaseHtmlBuilder;
use Form;
use Session;

class HtmlBuilder extends BaseHtmlBuilder
{
    public function flashMessage(): string
    {
        if (!Session::has('flash_notification.message')) {
            return '';
        }

        $level = Session::get('flash_notification.level');

        return el("div.alert.-{$level}", Session::get('flash_notification.message'));
    }

    public function error($message, $name = ''): string
    {
        if (empty($message) && empty($name)) {
            return '';
        }

        $attributes = empty($name) ? [] : ['data-validation-error' => $name];

        return el('div.alert.-danger', $attributes, $message);
    }

    public function message($message, string $classes = ''): string
    {
        if (empty($message)) {
            return '';
        }

        return el('div.alert.-success', ['class' => $classes], $message);
    }

    public function info($message, string $classes = ''): string
    {
        if (empty($message)) {
            return '';
        }

        return el('div.alert.-info', ['class' => $classes],
            el('span.fa.fa-info-circle') . ' ' . $message
        );
    }

    public function avatar(User $user, string $classes = ''): string
    {
        return el('span.avatar', [
            'class' => $classes,
            'style' => "background-image: url('{$user->present()->avatar()}')",
        ], '');
    }

    public function deleteButton(string $url): string
    {
        return Form::openButton(
            [
                'url' => $url,
                'method' => 'delete',
            ],
            [
                'class' => 'button -danger -small',
            ]
        ).el('span.fa.fa-remove').Form::closeButton();
    }

    public function onlineIndicator(bool $online): string
    {
        $state = $online ? 'on' : 'off';
        $icon = $online ? 'circle' : 'circle-o';
        $title = $online ? 'Online' : 'Offline';

        return el("span.status.-{$state}.-space-right", ['title' => $title],
            el("i.fa.fa-{$icon}")
        );
    }
}
