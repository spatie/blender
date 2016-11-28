<template>
    <tbody>
        <tr :style="{ background: markedForRemoval ? 'red' : '' }">
            <td></td>
            <td>{{ title }}</td>
            <td>{{ layout }}</td>
            <td>
                <a href="#" @click.prevent="edit">Edit</a>
                <a href="#" @click.prevent="toggleRemove">Remove</a>
            </td>
        </tr>
        <tr v-if="open">
            <td colspan="4">

            </td>
        </tr>
    </tbody>
</template>

<script>
import { inject } from 'vue-expose-inject'; 

export default {

    props: {
        open: {
            required: true,
            type: Boolean,
        },
        attributes: {
            required: true,
            type: Object,
        },
    },

    computed: {
        ...inject(['store']),
        
        title() {
            if (! this.attributes.name[this.store.contentLocale]) {
                return '[geen titel]';
            }

            return this.attributes.title;
        },

        layout() {
            return this.attributes.layout;
        },

        markedForRemoval() {
            return this.attributes.markedForRemoval;
        },
    },

    methods: {
        edit() {
            this.$emit('open');
        },

        toggleRemove() {
            this.attributes.markedForRemoval = !this.attributes.markedForRemoval;
        },
    },
};
</script>