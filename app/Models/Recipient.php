<?php

namespace App\Models;

class Recipient extends Model
{
    public static function forForm(string $form): array
    {
        if (! app()->environment('production')) {
            return [
                config('mail.development_recipient'),
            ];
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
