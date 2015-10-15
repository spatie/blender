var Elixir = require('laravel-elixir');
var del = require('del');
var favicons = require("favicons");
var gulp = require('gulp');
var gutil = require('gulp-util');
var sassdoc = require('sassdoc');
var svgmin = require('gulp-svgmin');

/* ------------------config------------------ */
var settings = require("./settings.js");
var config = settings.config;

/* ------------------ELixir extensions------------------ */

var Task = Elixir.Task;

Elixir.extend("svg", function(source) {
    new Task("svg", function() {
        return gulp.src( source )
            .pipe(svgmin())
            .pipe(gulp.dest(config.paths.svg.public));
    })
    .watch(config.paths.svg.resources + '*');
});



/* ------------------Separate gulp tasks------------------ */

/* Show gulp help in terminal */
gulp.task('help', function () {
    gutil.log('');
    gutil.log(gutil.colors.yellow('-------------------------------------'));
    gutil.log(gutil.colors.yellow('gulp'), '                     compile front assets');
    gutil.log(gutil.colors.yellow('gulp watch'), '               watch front assets and load browser-sync');
    gutil.log(gutil.colors.cyan(  '--production'), '             use flag to compile minified');
    gutil.log(gutil.colors.cyan(  '--back'), '                   use flag to compile or watch back module');
    gutil.log(gutil.colors.yellow('-------------------------------------'));
    gutil.log(gutil.colors.red(   'gulp phpunit'), '             run unit tests');
    gutil.log(gutil.colors.red(   'gulp favicon'), '             generate favicons');
    gutil.log(gutil.colors.red(   'gulp doc'), '                 generate documentation');
    gutil.log(gutil.colors.yellow('-------------------------------------'));
    gutil.log('');
});


/* PHP unit */
// Run all PHPUnit tests once

gulp.task('phpunit', function() {
    Elixir(function(mix){
        console.log("2015 08 14 - Broken");
        // https://github.com/laravel/elixir/issues/229
        // mix.phpUnit();
    });
});


/* Show gulp help in terminal */
gulp.task('doc', function () {
    return gulp.src('resources/assets/sass/**/*.scss')
        .pipe(sassdoc({
            dest: 'public/doc/sass/'
        }));
});


/* Generate favicons and update html view */
gulp.task('favicon', function () {

    //cleanup blade include first
    del(config.paths.favicons.view);

    //generate icons
    favicons({
            files: {
                src: config.paths.favicons.resources,
                dest: config.paths.favicons.public,
                html: config.paths.favicons.view,
                iconsPath: '/',
                androidManifest: config.paths.favicons.public,
                browserConfig: config.paths.favicons.public,
                firefoxManifest: config.paths.favicons.public,
                yandexManifest: config.paths.favicons.public
            },
            icons: {
                android: true,
                appleIcon: true,
                appleStartup: false,
                coast: false,
                favicons: true,
                firefox: true,
                opengraph: true,
                windows: true,
                yandex: false
            },
            config: {
                appName: config.app.name,
                appDescription: config.app.description,
                developer: 'spatie',
                developerURL: 'https://spatie.be',
                version: 1.0,
                background: '#ffffff',
                index: '/',
                url: config.app.url,
                silhouette: false,
                logging: false
            }
    });
});


