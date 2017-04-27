<?php

namespace App\Models\Traits;

trait HasMetaValues
{
    public function meta(): array
    {
        return array_merge(
            $this->defaultMetaValues(),
            array_filter($this->meta_values ?: [])
        );
    }
}
