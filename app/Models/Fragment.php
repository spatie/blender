<?php

namespace App\Models;

use Spatie\Blender\Model\Traits\HasMedia;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\TranslationLoader\LanguageLine;
use App\Models\Presenters\FragmentPresenter;

class Fragment extends LanguageLine implements HasMediaConversions
{
    use FragmentPresenter, HasMedia;

    protected static $logAttributes = ['name', 'text'];

    protected static $recordEvents = ['updated'];

    protected $mediaLibraryCollections = ['images'];

    public $casts = [
        'contains_html' => 'boolean',
        'hidden' => 'boolean',
        'text' => 'array',
    ];

    public $table = 'fragments';

    public function getDescriptionForEvent(string $eventName): string
    {
        $link = link_to_action('Back\\FragmentController@edit', $this->full_name, [$this->id]);

        return "Fragment '{$link}' werd bijgewerkt";
    }

    public function getNameAttribute(): string
    {
        return "{$this->group}.{$this->key}";
    }

    public function registerMediaConversions()
    {
        $this->addMediaConversion('admin')
            ->setWidth(368)
            ->setHeight(232)
            ->nonQueued();

        $this->addMediaConversion('thumb')
            ->setWidth(368)
            ->setHeight(232)
            ->performOnCollections('images');
    }
}
