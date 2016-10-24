import 'es6-symbol/implement';

import 'blender.js/modules/ajax.csrf';
import 'blender.js/modules/interface.confirm';
//import 'blender.js/modules/form.autosave';
import 'blender.js/modules/form.input.datetimepicker';
import 'blender.js/modules/form.select';
import 'blender.js/modules/form.textarea.autosize';
import 'blender.js/modules/form.locationpicker';
import 'blender.js/modules/table.datatables';
import 'blender.js/modules/table.sortable';
import 'blender.js/modules/tabs';

import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

new Vue({
    el: 'body',
    components: {
        media(resolve) {
            require.ensure([], require => {
                resolve(require('blender-media').default);
            }, 'front.blender-media');
        },
    },
});

// Heavy components coming up

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

