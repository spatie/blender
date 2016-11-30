import axios from 'axios';
import Vue from 'vue';

const Store = {

    data() {
        return {
            collection: '',
            createUrl: '',
            model: '',
            data: {},
            blocks: [],
            debug: false,
        };
    },

    computed: {
        export() {
            return JSON.stringify(
                this.blocks.filter(b => b.markedForRemoval === false)
            );
        },
    },

    methods: {
        init({ collection, createUrl, model, data, initial, debug = false }) {
            this.collection = collection;
            this.createUrl = createUrl;
            this.model = model;
            this.data = data;
            this.debug = debug;

            this.addBlocks(initial);
        },

        addBlocks(blocks) {
            this.blocks = [
                ...this.blocks,
                ...blocks.map(b => ({ ...b, markedForRemoval: false })),
            ];
        },

        async createBlock() {
            const { data: block } = await axios.post(this.createUrl, {
                model_name: this.model.name,
                model_id: this.model.id,
                collection_name: this.collection,
            });
            
            this.addBlocks([block]);
        },

        sendExportToConsole() {
            // eslint-disable-next-line no-console
            console.log(window.__contentBlocks = JSON.parse(this.export));
        },
    },
};

function createStore() {
    return new Vue(Store);
}

export default createStore;