<template>
    <fieldset>
        <legend>
            <div class="legend_lang">{{ locale }}<div>
        </legend>
        <slot></slot>
    </fieldset>
</template>

<script>
export default  {

    props: {
        locale: {
            type: String,
            required: true,
        },
    },
};
</script>