<template>
    <tbody>
        <tr :class="{ '-is-disabled': isMarkedForRemoval }">
            <td></td>
            <td @click="open">{{ name }}</td>
            <td class="-remark">{{ type }}</td>
            <td>
                <span v-if="! isMarkedForRemoval">
                    <a
                        v-if="isOpen"
                        href="#"
                        @click.prevent="close"
                    >Sluit</a>
                    <a
                        v-else
                        href="#"
                        @click.prevent="open"
                    >Wijzig</a>
                </span>
                <span v-if="! isOpen">
                    <a
                        v-if="isMarkedForRemoval"
                        href="#"
                        @click.prevent="restore"
                    >Herstel</a>
                    <a
                        v-else
                        href="#"
                        @click.prevent="markForRemoval"
                    >Verwijder</a>
                </span>
            </td>
        </tr>
        <tr v-if="isOpen">
            <td colspan="4">
                <editor
                    :block="block"
                    :data="data"
                ></editor>
            </td>
        </tr>
    </tbody>
</template>

<script>
import { forEach, keys, pick } from 'lodash';
import Editor from './Editor';
import Vue from 'vue';

export default {

    props: {
        block: {
            required: true,
            type: Object,
        },
        data: {
            required: true,
            type: Object,
        },
        isOpen: {
            required: true,
            type: Boolean,
        },
    },

    components: {
        Editor,
    },

    created() {
        if (! this.editor.types) {
            throw new Error('Please provide a set of types for the content ' +
                'blocks editor instance.');
        }

        if (! this.editor.translatableAttributes) {
            throw new Error('Please provide a set of translatable attributes ' + 
                'for the content blocks editor instance.');
        }

        if (! this.editor.mediaLibraryCollections) {
            throw new Error('Please provide a set of medialibrary collections ' + 
                'for the content blocks editor instance.');
        }

        if (! this.block.type) {
            this.block.type = Object.keys(this.editor.types)[0];
        }

        forEach(this.editor.translatableAttributes, (_, key) => {
            this.initializeTranslations(key);
        });
    },

    computed: {
        name() {
            return this.block.name[this.data.contentLocale] || '[geen titel]';
        },

        type() {
            return this.editor.types[this.block.type];
        },

        locales() {
            return this.data.locales;
        },

        isMarkedForRemoval() {
            return this.block.markedForRemoval;
        },

        editor() {
            return Editor;
        },
    },

    methods: {
        open() {
            this.$emit('open', { id: this.block.id });
        },

        close() {
            this.$emit('close', { id: this.block.id });
        },

        markForRemoval() {
            Vue.set(this.block, 'markedForRemoval', true);
            this.close();
        },

        restore() {
            Vue.set(this.block, 'markedForRemoval', false);
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
    },
};
</script>