<?php

namespace App\Foundation\Models\Traits;

use Carbon\Carbon;

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
    public function scopeDraft($query, $draft = true)
    {
        return $query->where('draft', $draft);
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
     * Get the non draft scope.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeNonDraft($query)
    {
        return $this->scopeDraft($query, false);
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
            ->nonDraft()
            ->where('online', true);
    }
}
