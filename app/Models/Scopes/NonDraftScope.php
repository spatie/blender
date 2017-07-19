<?php

namespace App\Models\Scopes;

use App\Models\Traits\Draftable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class NonDraftScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (in_array(Draftable::class, class_uses_recursive($model))) {
            $builder->where('draft', false);
        }
    }
}
