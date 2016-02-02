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
    require.ensure([], () => { require('./modules/chart').init(); }, 'back.chart');
}

if ($('[data-editor]').size()) {
    require.ensure([], () => { require('./modules/editor').init(); }, 'back.editor');
}

if ($('[data-media-collection]').size()) {
    require.ensure([], () => { require('./modules/media'); }, 'back.media');
}
