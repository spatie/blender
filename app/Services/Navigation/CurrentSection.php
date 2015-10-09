<?php

namespace App\Services\Navigation;

use Illuminate\Foundation\Application;

class CurrentSection
{
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Using a manual singleton since this can be called really early, in which case registering it via a service
     * provider could be unreliable.
     *
     * @var string
     */
    protected static $currentSection = null;

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Determine the current section from the request.
     *
     * @return string
     */
    public function determine()
    {
        if (static::$currentSection !== null) {
            return static::$currentSection;
        }

        $authSegments = ['auth', 'password'];

        if (
            in_array($this->app->request->segment(1), $authSegments) ||
            in_array($this->app->request->segment(2), $authSegments)
        ) {
            return static::$currentSection = 'auth';
        }

        if ($this->app->request->segment(1) === 'blender') {
            return static::$currentSection = 'blender';
        }

        return static::$currentSection = 'front';
    }

    /**
     * Determine wether the current section is the front.
     *
     * @return bool
     */
    public function isFront()
    {
        return $this->determine() === 'front';
    }

    /**
     * Determine wether the current section is Blender.
     *
     * @return bool
     */
    public function isBlender()
    {
        return $this->determine() === 'blender';
    }

    /**
     * Determine wether the current section is auth.
     *
     * @return bool
     */
    public function isAuth()
    {
        return $this->determine() === 'auth';
    }
}
