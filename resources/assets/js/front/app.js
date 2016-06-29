import 'babel-polyfill';
import viewport from 'viewport-utility';

if ($('[data-validate]').size()) {
    require.ensure([], () => {
        require('client-side-validation').init();
    }, 'front.validation');
}

viewport.init();
