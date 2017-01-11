import '../redactor/redactor/redactor.js';
import '../redactor/langs/nl.js';
import '../redactor/plugins/imagemanager.js';
import '../redactor/plugins/source.js';
import '../redactor/plugins/video.js';

function init() {
    $('[data-editor]').each(function () {
        initializeEditor($(this));
    });
}

function initializeEditor($textarea) {
    const apiUrl = $textarea.data('redactor-medialibrary-url');

    function triggerChange() {
        $textarea.trigger('change'); //trigger change for sisyphus script
    }

    function setUiIcons(redactor) {
        // font awesome is used
        redactor.button.set('image', '<i class="fa fa-image"></i>');
        redactor.button.set('video', '<i class="fa fa-video-camera"></i>');
        redactor.button.set('link', '<i class="fa fa-link"></i>');
        redactor.button.set('lists', '<i class="fa fa-list"></i>');
        redactor.button.set('format', '<i class="fa fa-paragraph"></i>');
        redactor.button.set('html', '<i class="fa fa-code"></i>');
    }

    $textarea.redactor({
        buttonsHide: ['deleted'],
        callbacks: {
            focus: triggerChange,
            change: triggerChange,
            init: function () {
                setUiIcons(this);
            },
        },
        formatting: ['p', 'h1', 'h2', 'h3', 'blockquote'],
        formattingAdd: {
            'p-intro': {
                title: 'Intro paragraph',
                args: ['p', 'class', 'p--intro'],
            },
        },
        imageUpload: apiUrl,
        imageCaption: false,
        lang: 'nl',
        pastePlainText: true,
        pasteImages: false,
        pasteLinks: false,
        plugins: ['video', 'source'],
        toolbarFixed: false, // no script, with sticky css
    });
}

export default init;
export { initializeEditor };
