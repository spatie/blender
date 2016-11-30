export default {

    props: ['block', 'data'],

    computed: {
        locales() {
            return this.data.locales;
        },
    },
};