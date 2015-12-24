<?php

namespace App\Foundation\Models\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface HasTags
{
    /**
     * Define the polymorphic relationship.
     *
     * @return MorphToMany
     */
    public function tags();

    /**
     * @return string
     */
    public static function getDefaultTagLocale();

    /**
     * @return string
     */
    public static function getDefaultTagType();
}
