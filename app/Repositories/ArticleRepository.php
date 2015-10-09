<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface ArticleRepository extends Repository
{
    /**
     * Get all online articles.
     *
     * @return \Illuminate\Database\Collection
     */
    public function getAllOnline();

    /**
     * Get all articles with a technical name like the string given.
     *
     * @param $technicalName
     *
     * @return Collection
     */
    public function getWithTechnicalNameLike($technicalName);

    /**
     * Get the article by it's technical name.
     *
     * @param string $technicalName
     *
     * @return \App\Models\Article
     */
    public function findByTechnicalName($technicalName);

    /**
     * Find a model by it's url.
     *
     * @param string $url
     * @param string $locale
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByUrl($url, $locale = null);
}
