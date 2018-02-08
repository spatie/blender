<?php

namespace App\Models\Scopes;

use App\Models\Traits\Draftable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OnlineScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (class_has_trait($model, Draftable::class)) {
            $builder->where('online', true);
        }
    }
}
