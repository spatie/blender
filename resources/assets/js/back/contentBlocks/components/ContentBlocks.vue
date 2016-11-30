<template>
    <div>
        <table>
            <tbody
                v-for="block in store.blocks"
                is="content-block"
                :block="block"
                :data="store.data"
                :is-open="isOpen(block)"
                @open="open"
                @close="close"
            ></tbody>
        </table>
        <a href="#" @click.prevent="store.createBlock">
            Blok toevoegen
        </a>
        <a
            v-if="store.debug"
            href="#"
            @click.prevent="store.sendExportToConsole"
        >
            Debug
        </a>
        <textarea
            :name="'content_blocks_' + store.collection"
            :value="store.export"
            style="display: none"
        ></textarea>
    </div>
</template>

<script>
import ContentBlock from './ContentBlock';

export default {

    props: ['store'],

    data() {
        return {
            currentlyOpen: null,
        };
    },

    components: {
        ContentBlock,
    },

    methods: {
        isOpen({ id }) {
            return this.currentlyOpen === id;
        },

        open({ id }) {
            if (this.isOpen(id)) {
                return;
            }

            this.currentlyOpen = id;
        },

        close({ id }) {
            if (! this.isOpen({ id })) {
                return;
            }

            this.currentlyOpen = null;
        },
    },
};
</script>