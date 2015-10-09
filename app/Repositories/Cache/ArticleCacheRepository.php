<?php

namespace App\Repositories\Cache;

use App\Repositories\ArticleRepository;
use App\Repositories\Database\ArticleDbRepository;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Database\Eloquent\Collection;

class ArticleCacheRepository extends CacheRepository implements ArticleRepository
{
    const CACHESECTION = 'articleRepository';

    /**
     * @param \Illuminate\Contracts\Cache\Repository $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
        $this->dbRepository = new ArticleDbRepository();
    }

    /**
     * Get all online models.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllOnline()
    {
        return $this->rememberForever('allOnline', function () {
            return $this->dbRepository->getAllOnline();
        });
    }

    /**
     * Find a model by it's url.
     *
     * @param string $url
     * @param string $locale
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByUrl($url, $locale = null)
    {
        $locale = $locale ?: content_locale();

        return $this->rememberForever("url.{$url}.{$locale}", function () use ($url, $locale) {
            return $this->dbRepository->findByUrl($url, $locale);
        });
    }

    /**
     * Get the article by it's technical name.
     *
     * @param string $technicalName
     *
     * @return \App\Models\Article
     */
    public function findByTechnicalName($technicalName)
    {
        return $this->rememberForever("technicalName.{$technicalName}", function () use ($technicalName) {
            return $this->dbRepository->findByTechnicalName($technicalName);
        });
    }

    /**
     * Get all articles with a technical name like the string given.
     *
     * @param $technicalName
     *
     * @return Collection
     */
    public function getWithTechnicalNameLike($technicalName)
    {
        return $this->rememberForever("getWithTechnicalNameLike.{$technicalName}", function () use ($technicalName) {
            return $this->dbRepository->getWithTechnicalNameLike($technicalName);
        });
    }
}
