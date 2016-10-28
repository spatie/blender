import 'es6-symbol/implement';

import 'blender.js/modules/ajax.csrf';
import 'blender.js/modules/interface.confirm';
import 'blender.js/modules/form.input.datetimepicker';
import 'blender.js/modules/form.select';
import 'blender.js/modules/form.textarea.autosize';
import 'blender.js/modules/form.locationpicker';
import 'blender.js/modules/table.datatables';
import 'blender.js/modules/table.sortable';
import 'blender.js/modules/tabs';

if (document.querySelector('.js-blender-media')) {
    require.ensure([], () => {
        require('./modules/media').default();
    }, 'back.media');
}

if ($('[data-chart]').length) {
    require.ensure([], () => {
        require('./modules/chart').default();
    }, 'back.chart');
}

// Uncomment if redactor files are present

if ($('[data-editor]').length) {
    require.ensure([], () => {
        require('./modules/editor').default();
    }, 'back.editor');
}
