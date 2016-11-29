<template>
    <div>
        <div v-for="locale in data.locales">
            <input type="text" v-model="block.name[locale]">
        </div>
        <media
            collection="images"
            type="images"
            :uploadUrl="data.mediaUrl"
            :model="mediaModel"
            :initial="block.images"
        ></media>
    </div>
</template>

<script>
import Media from 'blender-media';

export default {

    props: ['block', 'data'],

    components: {
        Media,
    },

    computed: {
        mediaModel() {
            return {
                name: this.data.className,
                id: this.block.id,
            };
        },
    },
};
</script>