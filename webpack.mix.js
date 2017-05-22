const { mix } = require('laravel-mix');

mix

    .js('resources/assets/js/front/head.js', 'public/js/front.head.js')
    .js('resources/assets/js/front/app.js', 'public/js/front.app.js')
    .sass('resources/assets/sass/front/front.scss', 'public/css/front.css')

    .js('resources/assets/js/back/head.js', 'public/js/back.head.js')
    .js('resources/assets/js/back/app.js', 'public/js/back.app.js')
    .sass('resources/assets/sass/back/back.scss', 'public/css/back.css')

    .version()

    .options({
        // Since we don't do any image preprocessing and write url's that are
        // relative to the site root, we don't want the sass loader to try to
        // follow paths in `url()` functions.
        processCssUrls: false,
    })

    .webpackConfig({
        output: {
            // The public path needs to be set to the root of the site so
            // Webpack can locate chunks at runtime.
            publicPath: '/',
        },

        module: {
            rules: [
                // With the `import-glob-loader` we can use globs in our import
                // statements in scss.
                {
                    test: /\.scss/,
                    loader: 'import-glob-loader',
                    enforce: 'pre',
                },
            ],
        },
    });
