import { keys, pick } from 'lodash';
import Vue from 'vue';

export default {

    props: ['block', 'data'],

    computed: {
        locales() {
            return this.data.locales;
        },
    },

    methods: {
        label(name, locale = null) {
            if (! locale) {
                return `block_${this.block.id}_${name}`;
            }

            return `block_${this.block.id}_${name}_${locale}`;
        },

        initializeTranslations(key, defaultValue = '') {
            let translations = this.block[key] || {};
            
            const blueprint = this.locales.reduce((translations, locale) => {
                translations[locale] = defaultValue;
                return translations;
            }, {});

            translations = pick({ ...blueprint, ...translations }, keys(blueprint));

            Vue.set(this.block, key, translations);
        },

        getTranslation(key, locale) {
            return this.block[key][locale];
        },

        setTranslation(key, locale, value) {
            Vue.set(this.block[key], locale, value);
        },
    },
};