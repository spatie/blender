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

// Heavy components coming up

if ($('[data-chart]').size()) {
    require.ensure([], () => { require('./modules/chart'); }, 'back.chart');
}

if ($('[data-editor]').size()) {
    require.ensure([], () => { require('./modules/editor'); }, 'back.editor');
}

if ($('[data-media-collection]').size()) {
    require.ensure([], () => { require('./modules/media'); }, 'back.media');
}
