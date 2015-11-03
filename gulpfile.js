/* Blender front-end build process */

require('dotenv').load()
var blenderGulp = require("blender-gulp")

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
        xip : (process.env.GULP_BROWSERSYNC_XIP === 'true'), // When using webfonts with domain restrictions: add xip.io as valid domain
        open : (process.env.GULP_BROWSERSYNC_OPEN === 'true') // Open browser automatically?
    }
};

blenderGulp.init()