<template>
    <div>
        <select :value="value">
            <option
                v-for="(label, value) in options"
                :value="value"
            >
                {{ label }}
            </option>
        </select>
    </div>
</template>

<script>
import $ from 'jquery';

export default {

    props: ['value', 'options', 'searchable'],

    mounted() {
        this.$select2 =
            $('select', this.$el)
                .select2({
                    minimumResultsForSearch: 10,
                })
                .on('change', e => this.$emit('input', e.target.value));
    },
};
</script>