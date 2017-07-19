<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Spatie\EloquentSortable\Sortable;

class SortableScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if ($model instanceof Sortable) {
            $builder->orderBy('order_column');
        }
    }
}
