<?php

use Carbon\Carbon;
use Faker\Generator;

class Faker
{
    /** @var \Faker\Generator */
    public $faker;

    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    public function sometimes() : bool
    {
        return $this->faker->boolean(50);
    }

    public function rarely() : bool
    {
        return $this->faker->boolean(20);
    }

    public function mostly() : bool
    {
        return $this->faker->boolean(80);
    }

    public function sentence() : string
    {
        return $this->faker->sentence(mt_rand(4, 8));
    }

    public function sentences(int $min, int $max = 0) : string
    {
        $amount = $max ? mt_rand($min, $max) : $min;

        return $this->faker->sentences($amount, true);
    }

    public function title() : string
    {
        return $this->faker->sentence(mt_rand(2, 5));
    }

    public function paragraph() : string
    {
        return $this->faker->paragraph(mt_rand(6, 10));
    }

    public function paragraphs(int $min, int $max = 0) : string
    {
        $amount = $max ? mt_rand($min, $max) : $min;

        return '<p>' . implode('</p><p>', $this->faker->paragraphs($amount)) . '</p>';
    }

    public function text() : string
    {
        return el('p.intro', $this->paragraph()) .
            el('h3', $this->sentence()) .
            el('p', $this->paragraph()) .
            el('blockquote', $this->paragraph()) .
            el('h3', $this->sentence()) .
            el('p', $this->paragraph()) .
            el('p', $this->paragraph());
    }

    public function person($firstName = '', $lastName = '') : array
    {
        $firstName = $firstName ?: $this->faker->firstName;
        $lastName = $lastName ?: $this->faker->lastName;
        $email = strtolower($firstName) . '.' . strtolower($lastName) . '@spatie.be';

        return compact('firstName', 'lastName', 'email');
    }

    public function pastDate() : Carbon
    {
        return Carbon::now()->addMinutes(-rand(0, 60 * 24 * 7 * 4));
    }

    public function futureDate() : Carbon
    {
        return Carbon::now()->addMinutes(rand(0, 60 * 24 * 7 * 4));
    }

    public function translate(string $text) : array
    {
        return array_fill_keys(config('app.locales'), $text);
    }

    public function __get(string $name)
    {
        return $this->faker->$name;
    }

    public function __call(string $method, array $arguments)
    {
        return $this->faker->$method(...$arguments);
    }
}

function faker() : Faker
{
    return app(Faker::class);
}
