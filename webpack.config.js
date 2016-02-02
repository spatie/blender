'use strict';

const webpack = require('webpack');

const config = require('blender-gulp/config/webpack');

config.entry = {
    'back.app': './js/back/app.js',
    'back.head': './js/back/head.js',
    'back.style': './sass/back/back.scss',
    'front.app': './js/front/app.js',
    'front.head': './js/front/head.js',
    'front.style': './sass/front/front.scss',
};

config.plugins.push(new webpack.ProvidePlugin({
    $: 'jquery',
    jQuery: 'jquery',
}));

module.exports = config;
