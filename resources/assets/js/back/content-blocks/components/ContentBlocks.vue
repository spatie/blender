<template>
    <div>
        <table>
            <thead>
                <th></th>
                <th>Title</th>
                <th>Layout</th>
                <th></th>
            </thead>
            <tbody
                v-for="block in blocks"
                is="content-block"
                :attributes="block"
                :open="isOpen(block)"
                @close="close(block)"
            ></tbody>
        </table>
        <a href="#" @click.prevent="store.createBlock">
            Blok toevoegen
        </a>
    </div>
</template>

<script>
import ContentBlock from './ContentBlock';
import { inject } from 'vue-expose-inject';

export default {

    data() {
        return {
            currentlyOpen: null,
        };
    },

    components: {
        ContentBlock,
    },

    computed: {
        ...inject(['store']),
        
        blocks() {
            return this.store.blocks;
        },
    },

    methods: {
        isOpen({ id }) {
            return this.currentlyOpen === id;
        },

        close({ id }) {
            if (! this.isOpen(id)) {
                return;
            }

            this.currentlyOpen = null;
        },
    },
};
</script>