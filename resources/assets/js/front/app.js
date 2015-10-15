/* ---------- Modernizr */

// require('browsernizr/test/css/animations');
// require('browsernizr/test/css/transforms3d');
// require('browsernizr/test/svg');
// require('browsernizr/test/touchevents');
// var modernizr = require('browsernizr'); // import the tests first

/* ---------- jQuery */

var $ = require('jquery');
global.jQuery = global.$ = $; //expose jQuery for redactor :(

/* ---------- Webfont Loader */

var webfont = require('webfontloader');
webfont.load({
    google: {
        families: ['Lato:100,300,400,500,700,900,300italic']
    },
    custom: {
        families: ['FontAwesome'],
        urls: ['/fonts/font-awesome/css/font-awesome.min.css']
    }
});

/* ---------- blender.js modules */

//require("blender.js/modules/ajax.csrf");
//require("spatie-front.js/modules/interface.viewport");
//require("spatie-front.js/modules/interface.tagfilter");


