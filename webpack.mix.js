const path = require('path');
const glob = require('glob-all');
const { mix } = require('laravel-mix');
const PurgecssPlugin = require('purgecss-webpack-plugin');

mix
    .js('resources/assets/js/front/app.js', 'public/js/front.app.js')
    .postCss('resources/assets/css/front/front.css', 'public/css/front.css')

    .js('resources/assets/js/back/app.js', 'public/js/back.app.js')
    .postCss('resources/assets/css/back/back.css', 'public/css/back.css')

    .version()

    .options({
        // Our own set of PostCSS plugins.
        postCss: [
            require('postcss-easy-import')(),
            require('tailwindcss')('./tailwind.js'),
            require('postcss-cssnext')(),
        ],

        // CSSNext already processes our css with Autoprefixer, so we don't
        // need mix to do it twice.
        autoprefixer: false,

        // Since we don't do any image preprocessing and write url's that are
        // relative to the site root, we don't want the css loader to try to
        // follow paths in `url()` functions.
        processCssUrls: false,
    })

    .webpackConfig(() => {
        const config = {};

        config.output = {
            // The public path needs to be set to the root of the site so
            // Webpack can locate chunks at runtime.
            publicPath: '/',

            // We'll place all chunks in the `js` folder by default so we don't
            // need to worry about ignoring them in our version control system.
            chunkFilename: 'js/[name].js',
        };

        if (mix.inProduction()) {
            config.plugins = [new PurgecssPlugin({
                    paths: glob.sync([
                        path.join(__dirname, 'app/**/*.php'),
                        path.join(__dirname, 'resources/views/**/*.blade.php'),
                        path.join(__dirname, 'resources/assets/js/**/*.vue'),
                        path.join(__dirname, 'resources/assets/js/**/*.js'),
                        path.join(__dirname, 'vendor/spatie/menu/**/*.php'),
                    ]),
                    extractors: [
                        {
                            extractor: class {
                                static extract(content) {
                                    return content.match(/[A-z0-9-:\/]+/g) || [];
                                }
                            },
                            extensions: ['html', 'js', 'php', 'scss', 'vue'],
                        },
                    ],
                    only: ['css/front.css'],
                })];
        }

        return config;
    });
