<template>
    <div class="module">
        <table ref="table" class="module__table">
            <tr
                v-for="block in blocks"
                is="content-block"
                :block="block"
                :data="data"
                :is-open="isOpen(block)"
                @open="open"
                @close="close"
                :data-block-id="block.id"
                class="js-content-blocks-row module__row"
            ></tr>
        </table>
        <div class="module__actions">
            <button class="module__button" @click.prevent="createBlock">
                Blok toevoegen
            </button>
            <button class="module__button--debug"
                v-if="debug"
                href="#"
                @click.prevent="sendExportToConsole"
            >
                Debug
            </button>
        </div>
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
import { matches, queryAll } from 'spatie-dom';
import dragula from 'dragula';
import constrain from 'dragula-constrain';


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

    mounted() {
        this.sortable = dragula([this.$refs.table], {
            moves(element, container, handleElement) {
                return matches(handleElement, '.js-handle');
            },
        });

        constrain(this.sortable);

        this.sortable.on('drop', function () {

            const order = queryAll('.js-content-blocks-row', this.$el)
                .map(row => row.dataset.blockId)
                .reduce((order, blockId) => {
                    order[blockId] = Object.keys(order).length;
                    return order;
                }, {});

            this.reorder(order);
        }.bind(this));
    },

    beforeDestroy() {
        this.sortable.destroy();
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

        reorder(order) {
            console.log(order);
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
