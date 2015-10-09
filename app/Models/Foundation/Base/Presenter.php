<?php

namespace App\Models\Foundation\Base;

use Laracasts\Presenter\Presenter as BasePresenter;

abstract class Presenter extends BasePresenter
{
    /**
     * Proxy methods that don't exist to the entity.
     *
     * @param $method
     * @param $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (method_exists($this, $method)) {
            return $this->{$method}($parameters);
        }

        return $this->entity->{$method}($parameters);
    }
}
