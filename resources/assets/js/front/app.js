import viewport from 'viewport-utility';

if ($('[data-validate]').size()) {
    require.ensure([], () => { require('./validation').init(); }, 'front.validation');
}

viewport.init();
