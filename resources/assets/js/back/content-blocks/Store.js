export default {

    data() {
        return {
            collection: '',
            createUrl: '',
            uploadUrl: '',
            model: '',
            associatedData: {},
            blocks: [],
        };
    },

    computed: {
        export() {
            return JSON.stringify(this.blocks);
        },
    },

    methods: {
        hydrate({ collection, model, associatedData, blocks }) {
            this.collection = collection;
            this.model = model;
            this.associatedData = associatedData;
            this.blocks = blocks;
        },
    },
};