<template>
    <div>
        <table>
            <tbody
                v-for="block in blocks"
                is="content-block"
                :block="block"
                :data="data"
                :is-open="isOpen(block)"
                @open="open"
                @close="close"
            ></tbody>
        </table>
        <a href="#" @click.prevent="createBlock">
            Blok toevoegen
        </a>
        <a
            v-if="debug"
            href="#"
            @click.prevent="sendExportToConsole"
        >
            Debug
        </a>
        <textarea
            :name="'content_blocks_' + collection"
            :value="exportable"
            style="display: none"
        ></textarea>
    </div>
</template>

<script>
import axios from 'axios';
import ContentBlock from './ContentBlock';

export default {

    props: {
        collection: {
            required: true,
            type: String,
        },
        createUrl: {
            required: true,
            type: String,
        },
        model: {
            required: true,
            type: Object,
        },
        data: {
            required: true,
            type: Object,
        },
        input: {
            required: true,
            type: Array,
        },
        debug: {
            default: false,
            type: Boolean,
        },
    },

    data() {
        return {
            blocks: this.input,
            currentlyEditingBlock: null,
        };
    },

    components: {
        ContentBlock,
    },

    computed: {
        exportable() {
            return JSON.stringify(
                this.blocks.filter(b => b.markedForRemoval !== true)
            );
        },
    },

    methods: {
        isOpen({ id }) {
            return this.currentlyEditingBlock === id;
        },

        open({ id }) {
            if (this.isOpen(id)) {
                return;
            }

            this.currentlyEditingBlock = id;
        },

        close({ id }) {
            if (! this.isOpen({ id })) {
                return;
            }

            this.currentlyEditingBlock = null;
        },

        createBlock() {
            axios
                .post(this.createUrl, {
                    model_name: this.model.name,
                    model_id: this.model.id,
                    collection_name: this.collection,
                })
                .then(({ data: block }) => this.blocks.push(block));
        },

        sendExportToConsole() {
            // eslint-disable-next-line no-console
            console.log(window.__contentBlocks = JSON.parse(this.exportable));
        },
    },
};
</script>