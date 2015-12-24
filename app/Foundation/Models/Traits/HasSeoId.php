<?php

namespace App\Foundation\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use function Spatie\array_rand_value;

trait HasSeoId
{
    protected static function bootHasSeoId()
    {
        static::creating(function (Model $model) {
            $model->generateSeoId();
        });
    }

    public function generateSeoId()
    {
        $allRecords = static::all()->pluck('seo_id')->toBase();

        $minId = 1000;
        $maxId = 9999;

        while ($allRecords->count() > $maxId * 0.8) {
            $maxId = $maxId * 10 + 9;
        }

        do {
            $seoId = rand($minId, $maxId);
        } while ($allRecords->contains($seoId));

        $this->seo_id = $seoId;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $seoId
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithSeoId(Builder $query, $seoId)
    {
        return $query->where('seo_id', $seoId);
    }
}
