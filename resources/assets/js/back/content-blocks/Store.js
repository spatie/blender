import axios from 'axios';
import Vue from 'vue';

const Store = {

    data() {
        return {
            collection: '',
            createUrl: '',
            mediaUrl: '',
            model: '',
            contentLocale: '',
            associatedData: {},
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
        initialize({ collection, createUrl, mediaUrl, model, contentLocale, associatedData }) {
            this.collection = collection;
            this.createUrl = createUrl;
            this.mediaUrl = mediaUrl;
            this.model = model;
            this.contentLocale = contentLocale;
            this.associatedData = associatedData;
        },

        addBlocks(blocks) {
            this.blocks = [
                ...this.blocks,
                ...blocks.map(b => ({ ...b, markedForRemoval: false })),
            ];
        },

        createBlock() {
            return axios.post(this.createUrl, {
                model_name: this.model.name,
                model_id: this.model.id,
                collection_name: this.collection,
            }).then(({ data: block }) => {
                this.addBlocks([block]);
            });
        },
    },
};

function createStore() {
    return new Vue(Store);
}

export default createStore;