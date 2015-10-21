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
    url: 'http://groener.be',
    browserSync: {
        proxy: 'http://groener.be.192.168.10.10.xip.io/',
        xip: false, //mostly when using webfonts with domain restrictions: add xip.io as valid domain
        open: false //open browser automatically?
    }
};

blenderGulp.init();