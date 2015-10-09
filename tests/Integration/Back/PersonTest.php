<?php

namespace App\Test\Integration\Back;

use App\Models\Person;
use PersonSeeder;

class PersonTest extends ModuleTestCase
{
    protected $name = 'person';
    protected $pluralName = 'people';
    protected $controller = 'Back\PersonController';
    protected $expectedProperties = [
        'id',
        'name',
        'url',
    ];

    public function setUp()
    {
        parent::setUp();

        $this->models = (new PersonSeeder())->seedRandomPeople(10);
    }
}
