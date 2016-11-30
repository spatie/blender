<template>
    <div>
        <fieldset v-for="locale in locales">
            <legend>
                <div class="legend_lang">{{ locale }}<div>
            </legend>
            <div class="form_group">
                <label :for="'block_' + block.id + '_name_' + block.locale">
                    Naam
                </label>
                <input
                    type="text"
                    v-model="block.name[locale]"
                    :id="'block_' + block.id + '_name_' + block.locale"
                >
            </div>
        </fieldset>
    </div>
</template>

<script>
import editor from '../mixins/editor';

export default {

    mixins: [editor],
};
</script>