import Media from 'blender-media';
import Vue from 'vue';

export default function init() {
    for (const el of document.querySelectorAll('.js-blender-media')) {
        new Vue({ el, render: createRenderer(el) });
    }
}

const createRenderer = (el) => (createElement) => {
    return createElement(Media, {
        props: {
            collection: el.getAttribute('data-collection'),
            type: el.getAttribute('data-type'),
            uploadUrl: el.getAttribute('data-upload-url'),
            model: JSON.parse(el.getAttribute('data-model')),
            initial: JSON.parse(el.getAttribute('data-initial')),
            data: JSON.parse(el.getAttribute('data-assocated-data')),
        },
    });
};
