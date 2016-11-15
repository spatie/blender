<template>
    <div>
        <textarea :value="store.export"></textarea>
    </div>
</template>

<script>
import { cloneDeep } from 'lodash';
import { expose } from 'vue-expose-inject';
import Store from '../Store';
import Vue from 'vue';

export default {

    mixins: [expose],

    props: {
        collection: { type: String, required: true },
        editor: { type: String, required: true },
        createUrl: { type: String, required: true },
        uploadUrl: { type: String, required: true },
        model: { type: Object, required: true },
        initial: { type: Array, required: true },
        associatedData: { type: Object, default: () => ({}) },
    },

    data() {
        const store = new Vue(Store);
        
        store.hydrate({
            collection: this.collection,
            blocks: cloneDeep(this.initial),
            model: cloneDeep(this.model),
            associatedData: cloneDeep(this.associatedData),
        });

        return { store };
    },

    expose() {
        return ['store'];
    },
};
</script>