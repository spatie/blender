<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Models\Traits\Draftable;

class OnlineScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (class_has_trait($model, Draftable::class)) {
            $builder->where('online', true);
        }
    }
}
