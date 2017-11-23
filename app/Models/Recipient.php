<?php

namespace App\Models;

class Recipient extends Model
{
    public static function forForm(string $form): array
    {
        if (! app()->environment('production')) {
            return array_wrap(config('mail.development_recipients'));
        }

        return static::where('form', $form)
            ->pluck('email')
            ->all();
    }

    /**
     * Needed by `updatedEventDescriptionFor` in `Controller`.
     */
    public function getNameAttribute(): ?string
    {
        return $this->form;
    }
}
