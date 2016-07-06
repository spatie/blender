## Blender

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/spatie-custom/blender/master.svg?style=flat-square)](https://travis-ci.org/spatie-custom/blender)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/c5299290-f351-490b-bda1-2309096ed28a.svg?style=flat-square)](https://insight.sensiolabs.com/projects/c5299290-f351-490b-bda1-2309096ed28a)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie-custom/blender.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie-custom/blender)

Blender is the Laravel template that is used for (nearly) all our projects.

You may use our template but please notice that we offer no support whatsoever. We also don't
follow semver for this project and won't guarantee that the code (especially the master branch) is stable. In short: when using this, you're on your own.

## Install

This guide assumes you're using [Laravel Homestead](https://github.com/laravel/homestead)

### Laravel App

Download the master branch

```bash
git clone git@github.com:spatie-custom/blender.git
```

Edit your Homestead.yaml file and add Blender as a site

```bash
sites:
    - { map: blender.dev, to: /home/vagrant/Sites/blender/public }
```

Install the composer dependencies

```bash
composer install
```

Make a copy `.env.example` and rename to `.env`

Finally make sure you have a database named `blender` in Homestead, and run the migrations and seeds

```bash
php artisan migrate --seed
```

### NPM

Installing Blender's npm dependecies requries Node ^4.4 and NPM ^3. Check your versions to be sure.

```bash
node -v
npm -v
```

We use a custom npm registry at [npm.spatie.be](https://npm.spatie.be) via [Sinopia](https://github.com/rlidwka/sinopia) for our private packages.

```bash
npm set registry http://npm.spatie.be
npm set ca null

npm install
```

Don't forget to remove the registry line from your `~/.npmrc` if you're planning to publish to npm at some point.

### Customisation

- Most of our projects are in Dutch. You can change the language in `config/app.php` and manage translations in `database/seeds/data/fragments.xlsx`
- We use [Redactor](https://imperavi.com/redactor/) from Imperavi as text editor but are not licensed to open source this. The text editor is hence degraded to a standard text area unless you comment out this part in `resources/assets/back/app.js`

### Gulp

Run `gulp help` to see available options. 

Blender uses our [blender-gulp](https://github.com/spatie-custom/blender-gulp) package for gulp tasks & setup, you will need to have [webpack](https://webpack.github.io/) installed globaly in order for gulp to work correctly `npm install -g webpack`.

To get you started for both front and back-end assets, run:

```bash
gulp
```

## Colofon

### Contributing

Generally we won't accept any PR requests to Blender. If you have discovered a bug or have an idea to improve the code, contact us first before you start coding.

### License

Blender and The Laravel framework are open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
