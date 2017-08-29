const { mix } = require('laravel-mix');

mix.config.postCss = require('./postcss.config').plugins;

mix

    .js('resources/assets/js/front/head.js', 'public/js/front.head.js')
    .js('resources/assets/js/front/app.js', 'public/js/front.app.js')
    .postCss('resources/assets/css/front/front.css', 'public/css/front.css')

    .js('resources/assets/js/back/head.js', 'public/js/back.head.js')
    .js('resources/assets/js/back/app.js', 'public/js/back.app.js')
    .postCss('resources/assets/css/back/back.css', 'public/css/back.css')

    .version()

    .options({
        // Since we don't do any image preprocessing and write url's that are
        // relative to the site root, we don't want the css loader to try to
        // follow paths in `url()` functions.
        processCssUrls: false,
    })

    .webpackConfig({
        output: {
            // The public path needs to be set to the root of the site so
            // Webpack can locate chunks at runtime.
            publicPath: '/',
            chunkFilename: 'js/[name]-[chunkhash].js',
        },
    });
