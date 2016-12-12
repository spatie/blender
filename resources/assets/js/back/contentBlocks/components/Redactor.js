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
};

export default {

    props: {
        name: {
            type: String,
            default: null,
        },
        value: {
            type: String,
            required: true, 
        },
        settings: {
            type: Object,
            default: () => ({}),
        },
    },

    render(h) {
        return h('textarea', {
            attrs: {
                name: this.name,
            },
            domProps: {
                value: this.value,
            },
            ref: 'textarea',
        }, '');
    },

    mounted() {
        const settings = { ...defaultSettings, ...this.settings };

        settings.callbacks = settings.callbacks || {};
        settings.callbacks.change = this.handleInput;
        
        $(this.$refs.textarea).redactor(settings);
    },

    methods: {
        handleInput(value) {
            this.$emit('input', value);
        },
    },
};