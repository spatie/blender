<?php

namespace App\HasMeta;

trait HasMeta
{
    /**
     * @param string|null $key
     *
     * @return string|\App\HasMeta\MetaValueCollection
     */
    public function meta(string $key = null)
    {
        if (is_null($key)) {
            return MetaValueCollection::make($this->metaValues());
        }

        return $this->meta()->get($key);
    }
}
