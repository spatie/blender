/* ---------- Modernizr */

// require('browsernizr/test/css/animations');
// require('browsernizr/test/css/transforms3d');
// require('browsernizr/test/svg');
// require('browsernizr/test/touchevents');
// var modernizr = require('browsernizr'); // import the tests first

/* ---------- jQuery */

var $ = require('jquery');
global.jQuery = global.$ = $; // expose jQuery for redactor :(

/* ---------- Webfont Loader */

require('components-webfontloader');

WebFont.load({
    google: {
        families: ['Lato:100,200,300,400,700,900,300italic']
    },
    custom: {
        families: ['FontAwesome'],
        urls: ['/fonts/font-awesome/css/font-awesome.min.css']
    }
});



/* ---------- blender.js modules */

require('blender.js/modules/ajax.csrf');

require('blender.js/modules/interface.confirm');

require('blender.js/modules/form.autosave'); // do this first
require('blender.js/modules/form.input.datetimepicker');
require('blender.js/modules/form.select');
require('blender.js/modules/form.textarea.autosize');
// require('blender.js/modules/form.textarea.parts');
require('blender.js/modules/form.locationpicker');

require('blender.js/modules/table.datatables');
require('blender.js/modules/table.sortable');

require('./media');
