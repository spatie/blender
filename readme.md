## Blender

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/spatie-custom/blender/master.svg?style=flat-square)](https://travis-ci.org/spatie-custom/blender)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/c5299290-f351-490b-bda1-2309096ed28a.svg?style=flat-square)](https://insight.sensiolabs.com/projects/c5299290-f351-490b-bda1-2309096ed28a)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie-custom/blender.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie-custom/blender)

Blender is the Laravel template that is used for (nearly) all our projects.

You may use our template but please notice that we offer no support whatsoever. We also don't
follow semver. We do not guarantee that the code is stable. In short: when using this
you're on your own.

## Quick install

### Laravel
- Download the master branch
- Edit your Homestead.yaml file and add Blender as site
- Create a DB 'Blender' in Homestead MySQL

Run in your VM project root folder:

```bash
composer install
php artisan migrate
php artisan db:seed
```

### NPM

We use our custom npm repository at npm.spatie.be via [Sinopia](https://github.com/rlidwka/sinopia) for our private packages.

```bash
npm set registry https://npm.spatie.be
npm set ca null
npm install
```

Don't forget to remove the registry line from your ~/.npmrc if you're planning to publish to npm at some point!


### Gulp

Run `gulp help` to see available options.
To get you started for both front and back-end assets, run:

```bash
gulp
gulp --back
```


###Contributing

Generally we won't accept any PR requests to Blender. If you have discovered a bug or have an idea to improve the code, contact us first before you start coding.

### License

Blender and The Laravel framework are open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
