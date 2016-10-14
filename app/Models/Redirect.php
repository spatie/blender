<?php

namespace App\Models;

use App\Foundation\Models\Base\ModuleModel;
use Illuminate\Support\Collection;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableInterface;

class Redirect extends ModuleModel implements SortableInterface
{
    use Sortable;

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
