const webpack = require('webpack');

const config = require('blender-gulp/config/webpack');

config.entry = {
    'back.vendor': ['jquery'],
    'back.head': './js/back/head.js',
    'back.app': './js/back/app.js',
    'back.style': './sass/back/back.scss',
    'front.head': './js/front/head.js',
    'front.app': './js/front/app.js',
    'front.style': './sass/front/front.scss',
};

config.plugins.push(new webpack.optimize.CommonsChunkPlugin({
    name: 'back.vendor',
    chunks: ['back.head', 'back.app', 'back.editor', 'back.chart'],
    filename: 'back.vendor.js',
}));

config.plugins.push(new webpack.ProvidePlugin({
    $: 'jquery',
    jQuery: 'jquery',
}));

module.exports = config;
