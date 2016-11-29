import ContentBlocks from './components/ContentBlocks';
import createStore from './createStore';
import { isString } from 'lodash';
import { props, queryAll } from 'spatie-dom';
import Vue from 'vue';

export default function mount(el, options = {}) {
    if (isString(el)) {
        return queryAll(el).map(el => mount(el, props(el)));
    }

    const store = createStore();
    store.init(options);
    
    new Vue({
        el,
        render(createElement) {
            return createElement(ContentBlocks, { props: { store } });
        },
    });
}