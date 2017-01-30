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
            // Webpack can locate chunks.
            publicPath: '/',

            // Prepend chunks with `chunk.` so we can easily ignore them in
            // the project's version control.
            chunkFilename: 'chunk.[name]-[chunkhash].js',
        },

        module: {
            rules: [
                {
                    test: /\.scss/,
                    loader: 'import-glob-loader',
                    enforce: 'pre',
                },
            ],
        },

        plugins: [
            new NormalModuleReplacementPlugin(
                /\.(jpe?g|png|gif|svg)$/,
                'node-noop'
            ),
        ],

        stats: {
            // The "pretty" errors sometimes lack information. Set a `DEBUG`
            // environment variable to enable a full stack trace.
            //
            // E.g. `DEBUG=1 yarn run dev`
            errors: process.env.DEBUG,
        },
    });
