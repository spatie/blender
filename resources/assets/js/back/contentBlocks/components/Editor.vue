<template>
    <div class="module__editor>">
        <div class="module__editor__column -stacked">
            <label>Type</label>
            <select2
                v-model="block.type"
                :options="types"
            ></select2>
            <locale
                v-for="locale in locales"
                :locale="locale"
            >
                <div v-for="(type, field) in translatableAttributes">
                    <div
                        :is="getFieldType(type)"
                        label="Label"
                        v-model="block[field][locale]"
                    ></div>
                </div>
            </locale>
            <media
                v-for="(type, collection) in mediaLibraryCollections"
                :type="type"
                :collection="collection"
                :uploadUrl="data.mediaUploadUrl"
                :model="{ name: data.mediaModel, id: block.id }"
                v-model="block[collection]"
            ></media>
        </div>
    </div>
</template>

<script>
import $ from 'jquery';
import editor from '../mixins/editor';

export default {

    mixins: [editor],

    types: {
        imageLeft: 'Afbeelding links',
        imageRight: 'Afbeelding rechts',
        noImage: 'Geen afbeelding',
    },

    translatableAttributes: {
        name: 'text',
        text: 'redactor',
    },

    mediaLibraryCollections: {
        image: 'image',
    },

    mounted() {
        $('[data-select]', this.$el)
            .select2()
            .on('change', e => this.block.type = e.target.value);
    },
};
</script>
