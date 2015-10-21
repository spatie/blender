/* Blender front-end build process */

var blenderGulp = require("blender-gulp");

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
    url: 'http://blender.spatie.be',
    browserSync: {
        proxy: 'http://blender.192.168.10.10.xip.io/',
        xip: false, // When using webfonts with domain restrictions: add xip.io as valid domain
        open: false // Open browser automatically?
    }
};

blenderGulp.init();