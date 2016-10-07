<?php

namespace App\Models;

use App\Models\Presenters\LanguageLinePresenter;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\TranslationLoader\LanguageLine;

class Fragment extends LanguageLine
{
    use LogsActivity, LanguageLinePresenter;

    protected static $logAttributes = ['name', 'text'];

    protected static $recordEvents = ['updated'];

    public function getDescriptionForEvent(string $eventName): string
    {
        $link = link_to_action('Back\\FragmentController@edit', $this->name, [$this->id]);

        return "Fragment '{$link}' werd bijgewerkt";
    }
}
