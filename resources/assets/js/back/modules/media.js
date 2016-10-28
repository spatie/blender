import Media from 'blender-media';
import Vue from 'vue';
import { props, queryAll } from '../util/dom';

export default function init() {
    queryAll('blender-media').forEach(el => {
        new Vue({
            el,
            render(createElement) {
                return createElement(Media, { props: props(el) });
            },
        });
    });
}
