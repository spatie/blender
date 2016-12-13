import Media from 'blender-media';
import Locale from '../components/forms/Locale';
import Redactor from '../components/forms/Redactor';
import PlainText from '../components/forms/PlainText';
import Vue from 'vue';

export default {

    props: ['block', 'data'],

    components: {
        Media,
        Locale,
        Redactor,
        PlainText,
    },

    computed: {
        types() {
            return this.$options.types;
        },
        
        translatableAttributes() {
            return this.$options.translatableAttributes;
        },
        
        mediaLibraryCollections() {
            return this.$options.mediaLibraryCollections;
        },
        
        locales() {
            return this.data.locales;
        },
    },

    methods: {
        getFieldType(type) {
            switch (type) {
                case 'redactor':
                    return 'redactor';
                case 'text':
                default:
                    return 'plain-text';
            }
        },

        getTranslation(key, locale) {
            return this.block[key][locale];
        },

        setTranslation(key, locale, value) {
            Vue.set(this.block[key], locale, value);
        },
    },
};