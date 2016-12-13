<template>
    <div>
        <select v-model="block.type">
            <option
                v-for="(label, type) in types"
                :value="type"
            >{{ label }}</option>
        </select>
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
</template>

<script>
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
};
</script>