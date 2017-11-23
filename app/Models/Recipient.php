<?php

namespace App\Models;

class Recipient extends Model
{
    public static function forForm(string $form): array
    {
        if (! app()->environment('production')) {
            return config('mail.development_recipients');
        }

        return static::where('form', $form)
            ->map(function (Recipient $recipient) {
                return [
                    'email' => $recipient->email,
                    'name' => $recipient->name,
                ];
            })
            ->all();
    }
}
