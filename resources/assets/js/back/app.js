import 'babel-polyfill';

window.jQuery = window.$ = require('jquery');

require('@spatie/blender-js/modules/ajax.csrf');
require('@spatie/blender-js/modules/interface.confirm');
require('@spatie/blender-js/modules/form.input.datetimepicker');
require('@spatie/blender-js/modules/form.select');
require('@spatie/blender-js/modules/form.textarea.autosize');
require('@spatie/blender-js/modules/form.locationpicker');
require('@spatie/blender-js/modules/table.datatables');
require('@spatie/blender-js/modules/table.sortable');
require('@spatie/blender-js/modules/tabs');

if (document.querySelector('blender-media')) {
    require.ensure(
        [],
        () => {
            require('./modules/media').default();
        },
        'back.media'
    );
}

if (document.querySelector('blender-content-blocks')) {
    require.ensure(
        [],
        () => {
            require('./modules/contentBlocks').default();
        },
        'back.blocks'
    );
}

if (document.querySelector('blender-chart')) {
    require.ensure(
        [],
        () => {
            require('./modules/chart').default();
        },
        'back.chart'
    );
}

// if (document.querySelector('[data-editor]')) {
//     require.ensure([], () => {
//         require('./modules/editor').default();
//     }, 'back.editor');
// }
