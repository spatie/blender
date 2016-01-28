/* ---------- Modernizr */

require('browsernizr/test/css/animations')
require('browsernizr/test/css/transforms3d')
require('browsernizr/test/svg')
require('browsernizr/test/touchevents')
require('browsernizr') // import the tests first

/* ---------- jQuery */

var $ = require('jquery')
global.jQuery = global.$ = $ // expose jQuery for redactor :(

/* ---------- Webfont Loader */

var webfont = require('webfontloader')
webfont.load({
    custom: {
        families: ['FontAwesome'],
        urls: ['/fonts/font-awesome/css/font-awesome.min.css'],
        testStrings: {
            FontAwesome: '\ue800',
        },
    },
})


/* ---------- blender.js modules */

require('blender.js/modules/ajax.csrf')
require('blender.js/modules/interface.confirm')

require('blender.js/modules/form.autosave') // do this first
require('blender.js/modules/form.input.datetimepicker')
require('blender.js/modules/form.select')
require('blender.js/modules/form.textarea.autosize')
require('blender.js/modules/form.textarea.editor')
// require('blender.js/modules/form.textarea.parts')
require('blender.js/modules/form.locationpicker')

require('blender.js/modules/table.datatables')
require('blender.js/modules/table.sortable')

require('./media')

require('./menu')
