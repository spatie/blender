/* ---------- Modernizr */

require('browsernizr/test/css/animations')
require('browsernizr/test/css/transforms3d')
require('browsernizr/test/svg')
require('browsernizr/test/touchevents')
require('browsernizr') // import the tests first

/* ---------- jQuery */

global.jQuery = global.$ = require('jquery')

/* ---------- Webfont Loader */

var webfont = require('webfontloader')
webfont.load({
    google: {
        families: ['Lato:100,300,400,500,700,900,300italic']
    },
    custom: {
        families: ['FontAwesome'],
        urls: ['/fonts/font-awesome/css/font-awesome.min.css']
    }
})

/* ---------- Viewport nav */

require('spatie-front.js/modules/interface.viewport')
