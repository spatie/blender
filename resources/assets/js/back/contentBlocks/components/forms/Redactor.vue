<template>
    <div class="form__group">
        <label>
            {{ label }}
        </label>
        <textarea
            :value="value"
            ref="textarea"
        ></textarea>
    </div>
</template>

<script>
const defaultSettings = {
    buttonsHide: ['deleted'],
    callbacks: {
        init() {
            this.button.set('image', '<i class="fa fa-image"></i>');
            this.button.set('video', '<i class="fa fa-video-camera"></i>');
            this.button.set('link', '<i class="fa fa-link"></i>');
            this.button.set('lists', '<i class="fa fa-list"></i>');
            this.button.set('format', '<i class="fa fa-paragraph"></i>');
            this.button.set('html', '<i class="fa fa-code"></i>');
        },
    },
    formatting: ['p', 'h1', 'h2', 'h3', 'blockquote'],
    formattingAdd: {
        'p-intro': {
            title: 'Intro paragraph',
            args: ['p', 'class', 'p--intro'],
        },
    },
    imageCaption: false,
    lang: 'nl',
    pastePlainText: true,
    pasteImages: false,
    pasteLinks: false,
    plugins: ['video', 'source'],
    toolbarFixed: false,
};

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
        settings: {
            type: Object,
            default: () => ({}),
        },
    },

    mounted() {
        const settings = { ...defaultSettings, ...this.settings };

        const $textarea = $(this.$refs.textarea);
        const emitInput = () => this.$emit('input', $textarea.val());

        $textarea.redactor(settings);

        $textarea.on('change.callback.redactor', () => {
            emitInput();
        });
    },
};
</script>
