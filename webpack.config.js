const webpack = require('webpack');

const config = require('blender-gulp/config/webpack')();

config.entry = {
    'back.head': './js/back/head.js',
    'back.app': './js/back/app.js',
    'back.style': './sass/back/back.scss',
    'front.head': './js/front/head.js',
    'front.app': './js/front/app.js',
    'front.style': './sass/front/front.scss',
};

config.plugins.push(new webpack.ProvidePlugin({
    $: 'jquery',
    jQuery: 'jquery',
}));

config.resolve.alias = {
    'vue$': 'vue/dist/vue.js',
};

module.exports = config;

