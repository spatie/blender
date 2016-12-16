<template>
    <div class="form__group">
        <label>
            {{ label }}
        </label>
        <input
            type="text"
            :value="value"
            @input="$emit('input', $event.target.value)"
        >
    </div>
</template>

<script>
export default {

    props: {
        value: {
            type: String,
            required: true,
        },
        label: {
            type: String,
            required: true,
        },
    },
};
</script>
