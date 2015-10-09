<?php

namespace App\Repositories;

interface FragmentRepository extends Repository
{
    /**
     * Find a fragment by it's name.
     *
     * @param string $name
     *
     * @return \App\Models\Fragment
     */
    public function findByName($name);
}
