import ContentBlocks from './components/ContentBlocks';
import Vue from 'vue';
import { props, queryAll } from 'spatie-dom';

export default function init() {
    queryAll('blender-content-blocks').forEach(el => mountContentBlocks(el));
}

function mountContentBlocks(el) {
    new Vue({
        el,
        render(createElement) {
            return createElement(ContentBlocks, { props: props(el) });
        },
    });
}