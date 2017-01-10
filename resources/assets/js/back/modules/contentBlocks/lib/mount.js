import ContentBlocks from '../components/ContentBlocks';
import { isString } from 'lodash';
import { props, queryAll } from 'spatie-dom';
import Vue from 'vue';

export default function mount(el) {
    if (isString(el)) {
        return queryAll(el).map(el => mount(el));
    }

    return new Vue({
        el,
        render(createElement) {
            return createElement(ContentBlocks, { props: props(el) });
        },
    });
}
