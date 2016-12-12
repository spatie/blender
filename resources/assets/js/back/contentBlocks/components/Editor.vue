<template>
    <div>
        <fieldset v-for="locale in locales">
            <legend>
                <div class="legend_lang">{{ locale }}<div>
            </legend>
            <div class="form__group">
                <label :for="label('name', locale)">
                    Naam
                </label>
                <input
                    type="text"
                    :id="label('name', locale)"
                    :value="getTranslation('name', locale)"
                    @input="setTranslation('name', locale, $event.target.value)"
                >
            </div>
            <div class="form__group">
                <label :for="label('name', locale)">
                    Tekst
                </label>
                <redactor
                    :value="getTranslation('text', locale)"
                    @input="setTranslation('text', locale, $event)"
                ></redactor>
            </div>
        </fieldset>
        <media
            v-for="media in block.media"
            :type="media.type"
            :collection="media.collection"
            :uploadUrl="media.uploadUrl"
            :model="media.model"
            :value="media.media"
            :data="{}"
        ></media>
    </div>
</template>

<script>
import editor from '../mixins/editor';
import Media from 'blender-media';
import Redactor from './Redactor';

export default {

    mixins: [editor],

    components: {
        Media,
        Redactor,
    },

    created() {
        this.initializeTranslations('name');
        this.initializeTranslations('text');
    },
};
</script>