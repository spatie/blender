import 'blender.js/modules/ajax.csrf';
import 'blender.js/modules/interface.confirm';
import 'blender.js/modules/form.autosave';
import 'blender.js/modules/form.input.datetimepicker';
import 'blender.js/modules/form.select';
import 'blender.js/modules/form.textarea.autosize';
import 'blender.js/modules/form.locationpicker';
import 'blender.js/modules/table.datatables';
import 'blender.js/modules/table.sortable';

// Heavy components coming up

if ($('[data-chart]').size()) {
    require.ensure([], () => { require('./modules/chart').default(); }, 'back.chart');
}

if ($('[data-media-collection]').size()) {
    require.ensure([], () => { require('./modules/media'); }, 'back.media');
}

// Uncomment if redactor files are present
/*
if ($('[data-editor]').size()) {
    require.ensure([], () => { require('./modules/editor').default(); }, 'back.editor');
}
*/
