<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Traits\Draftable;

class OnlineScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if ($model instanceof Draftable) {
            $builder->where('online', true);
        }
    }
}
