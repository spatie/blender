require('browsernizr/test/css/animations');
require('browsernizr/test/css/transforms3d');
require('browsernizr/test/svg');
require('browsernizr/test/touchevents');
require('browsernizr');

global.jQuery = global.$ = require('jquery');

const webfont = require('webfontloader')
webfont.load({
    custom: {
        families: ['FontAwesome'],
        urls: ['/fonts/font-awesome/css/font-awesome.min.css'],
        testStrings: {
            FontAwesome: '\ue800',
        },
    },
});

require('blender.js/modules/ajax.csrf');
require('blender.js/modules/interface.confirm');

require('blender.js/modules/form.autosave');
require('blender.js/modules/form.input.datetimepicker');
require('blender.js/modules/form.select');
require('blender.js/modules/form.textarea.autosize');
require('blender.js/modules/form.textarea.editor');
// require('blender.js/modules/form.textarea.parts');
require('blender.js/modules/form.locationpicker');

require('blender.js/modules/table.datatables');
require('blender.js/modules/table.sortable');

require('./media');
require('./menu');

if ($('data-chart').size()) {
    require.ensure([], () => { require('./chart'); }, 'back.chart');
}
