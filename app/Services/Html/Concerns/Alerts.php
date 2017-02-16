<?php

namespace App\Services\Html\Concerns;

use Spatie\Html\Elements\Div;

trait Alerts
{
    public function alert(string $type, string $message): Div
    {
        return $this->div()
            ->class("alert--{$type}")
            ->html($message);
    }

    public function flashMessage(): ?Div
    {
        if (
            ! $this->request->session()->get('flash_notification.level') ||
            ! $this->request->session()->get('flash_notification.message')
        ) {
            return null;
        }

        return $this->alert(
            $this->request->session()->get('flash_notification.level'),
            $this->request->session()->get('flash_notification.message')
        );
    }

    public function error(?string $message = '', string $field = ''): ?Div
    {
        if (! $message) {
            return null;
        }

        return $this->alert('danger', $message)
            ->attributeIf($field, 'data-validation-error', $field);
    }

    public function message($message = ''): Div
    {
        return $this->alert('success', $message);
    }

    public function info($message = ''): Div
    {
        return $this->alert(
            'info',
            $this->icon('info-circle').' '.$message
        );
    }

    public function warning($message = ''): Div
    {
        return $this->alert(
            'warning',
            $this->icon('exclamation-triangle').' '.$message
        );
    }
}
