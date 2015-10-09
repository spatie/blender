<?php

namespace App\Repositories;

interface PersonRepository extends Repository
{
    /**
     * Get all online models.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllOnline();

    /**
     * Get all online models with a certain type.
     *
     * @param string $type
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getWithType($type);

    /**
     * Get a person from his url.
     *
     * @param string $url
     *
     * @return \App\Models\Person
     */
    public function findByUrl($url);

    /**
     * Set the new order.
     *
     * @param array $ids
     */
    public function setNewOrder($ids);
}
