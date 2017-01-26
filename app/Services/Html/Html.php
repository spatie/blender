<?php

namespace App\Services\Html;

use Spatie\Html\Elements\A;
use Spatie\Html\Elements\Div;
use Spatie\Html\Elements\Span;

class Html extends \Spatie\Html\Html
{
    public function alert(string $type, string $message): Div
    {
        return static::div()
            ->class(['alert', "-{$type}"])
            ->text($message);
    }

    public function flashMessage(): Div
    {
        if (! Session::has('flash_notification.message')) {
            return static::div();
        }

        return static::alert(
            Session::get('flash_notification.level'),
            Session::get('flash_notification.message')
        );
    }

    public function error(string $message, string $field = ''): Div
    {
        return static::alert('danger', $message)
            ->attributeIf($field, 'data-validation-error', $field);
    }

    public function message($message): Div
    {
        return static::alert('success', $message);
    }

    public function info($message): Div
    {
        return static::alert(
            'info',
            static::icon('info-circle').' '.$message
        );
    }

    public function warning($message): Div
    {
        return static::alert(
            'warning',
            static::icon('exclamation-triangle').' '.$message
        );
    }

    public function icon(string $icon): Span
    {
        return static::span()->class("fa fa-{$icon}");
    }

    public function avatar(User $user): Span
    {
        return static::span()
            ->class('avatar')
            ->attribute('style', "background-image: url('{$user->avatar}')");
    }

    //public function deleteButton(string $url): string
    //{
    //    return Form::openButton(
    //            [
    //                'url' => $url,
    //                'method' => 'delete',
    //            ],
    //            [
    //                'class' => 'button--delete-row',
    //            ]
    //        ).el('span.fa.fa-trash').Form::closeButton();
    //}

    public function onlineIndicator(bool $online): Span
    {
        return static::icon($online ? 'circle' : 'circle-o')
            ->class($online ? 'on' : 'off');
    }

    public function backToIndex(string $action, array $parameters = []): A
    {
        return static::a(
            action($action, $parameters),
            fragment('back.backToIndex')
        )->class('breadcrumb--back');
    }
}
