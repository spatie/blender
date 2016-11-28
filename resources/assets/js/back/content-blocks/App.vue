<template>
    <div>
        <content-blocks></content-blocks>
        <textarea
            :name="'content_blocks_' + store.collection"
            :value="store.export"
            style="display: none"
        ></textarea>
    </div>
</template>

<script>
import ContentBlocks from './components/ContentBlocks';
import { cloneDeep } from 'lodash';
import { expose } from 'vue-expose-inject';
import createStore from './Store';

export default {

    mixins: [expose],

    props: {
        collection: {
            type: String,
            required: true,
        },
        editor: {
            type: String,
            required: true,
        },
        createUrl: {
            type: String,
            required: true,
        },
        mediaUrl: {
            type: String,
            required: true,
        },
        model: {
            type: Object,
            required: true,
        },
        initial: {
            type: Array,
            required: true,
        },
        contentLocale: {
            type: String,
            required: true,
        },
        associatedData: {
            type: Object,
            default: () => ({}),
        },
    },

    components: {
        ContentBlocks,
    },

    data() {
        const store = createStore();
        
        store.initialize({
            collection: this.collection,
            createUrl: this.createUrl,
            mediaUrl: this.mediaUrl,
            model: this.model,
            contentLocale: this.contentLocale,
            associatedData: this.associatedData,
        });

        store.addBlocks(this.initial);

        return { store };
    },

    expose: ['store'],
};
</script>