/* Blender front-end build process */

var blenderGulp = require("blender-gulp");
require('dotenv').load();

blenderGulp.options = {
    files : {
        front : {
            sass : 'front/front.scss',
            js : ['app.js']
        },
        back : {
            sass : 'back/back.scss',
            js : ['app.js', 'chart.js']
        }
    },
    url : process.env.GULP_URL,
    browserSync : {
        proxy : process.env.GULP_BROWSERSYNC_PROXY,
        xip : process.env.GULP_BROWSERSYNC_XIP, // When using webfonts with domain restrictions: add xip.io as valid domain
        open : process.env.GULP_BROWSERSYNC_OPEN // Open browser automatically?
    }
};

blenderGulp.init();