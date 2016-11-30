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
import Editor from './Editor';
import { getTranslation } from '../lib/helpers.js';

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

    computed: {
        name() {
            return getTranslation(this.block.name, this.data.contentLocale, '[geen titel]');
        },

        type() {
            return this.block.type || '[geen type]';
        },
        
        isMarkedForRemoval() {
            return this.block.markedForRemoval;
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
            this.block.markedForRemoval = true;
            this.close();
        },

        restore() {
            this.block.markedForRemoval = false;
        },
    },
};
</script>