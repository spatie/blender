## Blender

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/spatie-custom/blender/master.svg?style=flat-square)](https://travis-ci.org/spatie-custom/blender)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/c5299290-f351-490b-bda1-2309096ed28a.svg?style=flat-square)](https://insight.sensiolabs.com/projects/c5299290-f351-490b-bda1-2309096ed28a)
[![StyleCI](https://styleci.io/repos/43971660/shield?branch=master)](https://styleci.io/repos/43971660)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie-custom/blender.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie-custom/blender)

Blender is the Laravel template that is used for (nearly) all our projects.

You may use our template but please notice that we offer no support whatsoever. We also don't
follow semver for this project and won't guarantee that the code (especially the master branch) is stable. In short: when using this, you're on your own.

## Requirements

PHP 7

## Install

This guide assumes you're using [Laravel Valet](https://github.com/laravel/valet)

### Laravel App

Download the master branch

```bash
git clone https://github.com/spatie/blender.git
```

Install the composer dependencies

```bash
composer install
```

Make a copy `.env.example` and rename to `.env`

Finally make sure you have a database named `blender`, and run the migrations and seeds

```bash
php artisan migrate --seed
```

### Assets

Installing Blender's front end dependecies requries `yarn`.

```
yarn
```

Blender uses [Laravel Mix](https://laravel.com/docs/5.4/mix) to build assets.
To build assets run:

```bash
yarn run dev
```

Available build tasks are defined in `package.json`


### Customisation

- Most of our projects are in Dutch. You can change the language in `config/app.php` and manage translations in `database/seeds/data/fragments.xlsx`
- We use [Redactor](https://imperavi.com/redactor/) from Imperavi as text editor but are not licensed to open source this. The text editor is hence degraded to a standard text area unless you comment out this part in `resources/assets/back/app.js`

## Colofon

### Contributing

Generally we won't accept any PR requests to Blender. If you have discovered a bug or have an idea to improve the code, contact us first before you start coding.

### License

Blender and The Laravel framework are open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
