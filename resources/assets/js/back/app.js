//global.jQuery = global.$ = require('jquery'); //present in head.js

require('blender.js/modules/ajax.csrf');
require('blender.js/modules/interface.confirm');

require('blender.js/modules/form.autosave');
require('blender.js/modules/form.input.datetimepicker');
require('blender.js/modules/form.select');
require('blender.js/modules/form.textarea.autosize');
// require('blender.js/modules/form.textarea.parts');
require('blender.js/modules/form.locationpicker');

require('blender.js/modules/table.datatables');
require('blender.js/modules/table.sortable');

require('./media');


if ($('data-chart').size()) {
    require.ensure([], () => { require('./chart'); }, 'back.chart');
}
