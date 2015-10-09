/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 */

/* config */
var settings = require("./resources/gulp/settings.js");
var config = settings.config;
var files = settings.files;

//disable notifications
if (config.disableNotifier) process.env.DISABLE_NOTIFIER = true;

/* Require npm modules */
var elixir = require('laravel-elixir');
var gutil = require('gulp-util');
require('laravel-elixir-browser-sync');


/* Proccess settings */
process.env.module = (gutil.env.back == 1) ? 'back' : 'front';
process.env.dev = (gutil.env.back == 1) ? config.app.dev + '/blender' : config.app.dev;
elixir.config.sourcemaps = false;

/* Custom extensions */
var extensions = require("./resources/gulp/extend.js");

/* Elixir main function */
elixir(function (mix) {


    /* NPM -> Javascript */

    files[process.env.module].js.map( function(item) {
        mix.browserify( process.env.module + '/' + item , config.paths.js.public + process.env.module + '.' + item );
    })


    mix

        .svg(config.paths.svg.resources + '*')

        /* Sass -> CSS */

        //compile sass to resources/css. Extra includePaths for @imports eg. from vendor/node_modules
        .sass(files[process.env.module].sass, config.paths.css.resources + process.env.module + '.css', {includePaths: [config.paths.node]})

         /* Combine prefixed CSS */

        //combine resources css to public
        .styles(files[process.env.module].css, config.paths.css.public + process.env.module + '.css', config.paths.relativeRoot)

        /* Version CSS & Javascript */

        //versioning public css & js
        .version( [ config.paths.css.public , config.paths.js.public  ] )

        .browserSync([
            'public/build/*',
            'resources/views/**/*'
        ], {
            proxy: process.env.dev,
            reloadDelay: 1000
        });
    ;


});

