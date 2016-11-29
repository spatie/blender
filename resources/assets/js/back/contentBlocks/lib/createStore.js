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
        init({ collection, createUrl, model, data, initial }) {
            this.collection = collection;
            this.createUrl = createUrl;
            this.model = model;
            this.data = data;

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
    },
};

function createStore() {
    return new Vue(Store);
}

export default createStore;