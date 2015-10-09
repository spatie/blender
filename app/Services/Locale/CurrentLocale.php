<?php

namespace App\Services\Locale;

use App\Services\Navigation\CurrentSection;
use Illuminate\Foundation\Application;

class CurrentLocale
{
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param $locale
     *
     * @return bool
     */
    public function isValidLocale($locale)
    {
        $locales = $this->app->config->get('app.locales');

        return in_array($locale, $locales);
    }

    /**
     * @param $locale
     *
     * @return bool
     */
    public function isValidBackLocale($locale)
    {
        $backLocales = $this->app->config->get('app.backLocales');

        return in_array($locale, $backLocales);
    }

    /**
     * Determine the locale for the current module.
     *
     * @return string
     */
    public function determine()
    {
        $default = $this->app->getLocale();

        if ($this->currentSection() === 'auth') {
            return $this->isValidBackLocale($this->app->request->segment(1)) ?
                $this->app->request->segment(1) : $default;
        }

        if ($this->currentSection() === 'back') {
            // User might not be set yet if called in a service provider so a fallback is provided
            if ($this->app->auth->user() !== null) {
                return $this->app->auth->user()->locale;
            }

            return $default;
        }

        return $this->isValidLocale($this->app->request->segment(1)) ? $this->app->request->segment(1) : $default;
    }

    /**
     * Get the locale in which the content in lists of the back module must be rendered.
     *
     * @return string
     */
    public function getContentLocale()
    {
        if (!$this->isValidLocale(app()->getLocale())) {
            return $this->app->config->get('app.locales')[0];
        }

        return locale();
    }

    /**
     * Retrieve the current application section.
     */
    protected function currentSection()
    {
        return $this->app->make(CurrentSection::class)->determine();
    }
}
