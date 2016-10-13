<?php

namespace App\Models;

use App\Models\Presenters\FragmentPresenter;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\TranslationLoader\LanguageLine;

class Fragment extends LanguageLine
{
    use LogsActivity, FragmentPresenter;

    protected static $logAttributes = ['name', 'text'];

    protected static $recordEvents = ['updated'];

    public $casts = [
        'contains_html' => 'boolean',
        'hidden' => 'boolean',
        'text' => 'array',
    ];

    public $table = 'fragments';

    public function getDescriptionForEvent(string $eventName): string
    {
        $link = link_to_action('Back\\FragmentController@edit', $this->fullName, [$this->id]);

        return "Fragment '{$link}' werd bijgewerkt";
    }
}
