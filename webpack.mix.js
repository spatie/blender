const process = require('process');
const { mix } = require('laravel-mix');
const { NormalModuleReplacementPlugin } = require('webpack');

mix

    .js('resources/assets/js/front/head.js', 'public/js/front.head.js')
    .js('resources/assets/js/front/app.js', 'public/js/front.app.js')
    .sass('resources/assets/sass/front/front.scss', 'public/css/front.css')

    .js('resources/assets/js/back/head.js', 'public/js/back.head.js')
    .js('resources/assets/js/back/app.js', 'public/js/back.app.js')
    .sass('resources/assets/sass/back/back.scss', 'public/css/back.css')

    .version()

    .webpackConfig({
        output: {
            // The public path needs to be set to the root of the site so
            // Webpack can locate chunks at runtime.
            publicPath: '/',

            // Prepend chunks with `chunk.` so we can easily ignore them in
            // the project's version control.
            chunkFilename: 'js/[name]-[chunkhash].js',
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

        plugins: [
            // We'll replace files we want to ignore with a `noop` so webpack
            // won't complain that they can't be resolved.
            new NormalModuleReplacementPlugin(
                /\.(jpe?g|png|gif|svg|woff2?|ttf|eot|svg|otf)$/,
                'node-noop'
            ),
        ],

        stats: {
            // The "pretty" errors sometimes lack information. To display full
            // stack traces, run `DEBUG=1 yarn run dev`.
            errors: process.env.DEBUG,
        },
    });
