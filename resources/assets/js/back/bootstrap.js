require('babel-polyfill');

/**
 * We'll set up axios to send the headers Laravel expects, and to add a csrf
 * token to the request if it's available.
 */

const axios = require('axios');

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    // eslint-disable-next-line no-console
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * We'll install our Vue plugins and global components here.
 */

const Vue = require('vue');

Vue.config.productionTip = false;

const TableComponent = require('vue-table-component').default;

Vue.use(TableComponent);
