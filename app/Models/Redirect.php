<?php

namespace App\Models;

use Spatie\Blender\Model\Model;
use Illuminate\Support\Collection;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Redirect extends Model implements Sortable
{
    use SortableTrait;

    protected $guarded = ['id'];

    public static function getAll(): Collection
    {
        return static::nonDraft()->orderBy('order_column')->get();
    }

    public function getNameAttribute()
    {
        return "{$this->old_url} => {$this->new_url}";
    }
}
