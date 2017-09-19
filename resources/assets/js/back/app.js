import 'babel-polyfill';

require('@spatie/blender-js/modules/ajax.csrf');
require('@spatie/blender-js/modules/interface.confirm');
require('@spatie/blender-js/modules/form.input.datetimepicker');
require('@spatie/blender-js/modules/form.select');
require('@spatie/blender-js/modules/form.textarea.autosize');
require('@spatie/blender-js/modules/form.locationpicker');
require('@spatie/blender-js/modules/table.datatables');
require('@spatie/blender-js/modules/table.sortable');
require('@spatie/blender-js/modules/tabs');

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

if (query('[data-editor]')) {
    require.ensure([], () => {
        require('./modules/editor').default();
    }, 'back.editor');
}
