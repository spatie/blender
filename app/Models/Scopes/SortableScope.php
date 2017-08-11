<?php

namespace App\Models\Scopes;

use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class SortableScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if ($model instanceof Sortable) {
            $builder->orderBy('order_column');
        }
    }
}
