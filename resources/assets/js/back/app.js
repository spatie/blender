import 'babel-polyfill';

import '@spatie/blender-js/modules/ajax.csrf';
import '@spatie/blender-js/modules/interface.confirm';
import '@spatie/blender-js/modules/form.input.datetimepicker';
import '@spatie/blender-js/modules/form.select';
import '@spatie/blender-js/modules/form.textarea.autosize';
import '@spatie/blender-js/modules/form.locationpicker';
import '@spatie/blender-js/modules/table.datatables';
import '@spatie/blender-js/modules/table.sortable';
import '@spatie/blender-js/modules/tabs';

import { query } from 'spatie-dom';

if (query('blender-media')) {
    require.ensure([], () => {
        require('./modules/media').default();
    }, 'back.media');
}

if (query('blender-content-blocks')) {
    require.ensure([], () => {
        require('./modules/contentBlocks').default();
    }, 'back.blocks');
}

if (query('blender-chart')) {
    require.ensure([], () => {
        require('./modules/chart').default();
    }, 'back.chart');
}

// if (query('[data-editor]')) {
//     require.ensure([], () => {
//         require('./modules/editor').default();
//     }, 'back.editor');
// }
