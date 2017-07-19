<?php

namespace App\Models\Traits;

use App\Models\Scopes\NonDraftScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait Draftable
{
    public $wasDraft = false;

    protected static function bootDraftable()
    {
        static::updating(function ($model) {
            $model->wasDraft = $model->isDraft();
            $model->draft = false;
        });
    }

    /**
     * Determine if this model is a draft.
     *
     * @return bool
     */
    public function isDraft()
    {
        return $this->draft;
    }

    /**
     * Get the draft scope.
     *
     * @param $query
     * @param bool $draft set to true to get only the drafts and to false for all non drafts
     *
     * @return mixed
     */
    public function scopeDraft(Builder $query, $draft = true)
    {
        return $query
            ->withoutGlobalScope(NonDraftScope::class)
            ->where('draft', $draft);
    }

    /**
     * Get draft that are older than the given numberOfHours.
     *
     * @param $query
     * @param int $numberOfHours
     *
     * @return mixed
     */
    public function scopeDraftsOlderThanHours($query, $numberOfHours)
    {
        return $query
            ->draft()
            ->where('created_at', '<=', Carbon::now()->subHours($numberOfHours)->toDateString());
    }

    /**
     * Get the online scope.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeOnline($query)
    {
        return $query
            ->where('online', true);
    }
}
