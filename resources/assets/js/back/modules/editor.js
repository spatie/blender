/* global $ */

import '../redactor/redactor/redactor.js';
import '../redactor/plugins/source.js';
import '../redactor/plugins/video.js';
// import '../redactor/plugins/imagemanager.js'; // Needs a json endpoint

$.Redactor.settings = {
    plugins: ['video', 'source'],
    buttons: [
        'format',
        'bold',
        'italic',
        'lists',
        'link',
        'horizontalrule',
        'image',
        'video',
        'file',
        'html',
    ],
    formatting: ['p', 'h1', 'h2', 'h3', 'blockquote'],
    formattingAdd: {
        'p-intro': {
            title: 'Intro paragraph',
            args: ['p', 'class', 'p--intro'],
        },
        'p-footnote': {
            title: 'Footnote',
            args: ['p', 'class', 'p--footnote'],
        },
        'p-caption': {
            title: 'Caption',
            args: ['p', 'class', 'p--caption'],
        },
    },
    imageCaption: true,
    imageResizable: true,
    pastePlainText: true,
    pasteImages: false,
    toolbarFixed: false, // Done by sticky CSS
};

function init() {
    $('[data-editor]').each(function() {
        initializeEditor($(this));
    });
}

function initializeEditor($textarea) {
    const apiUrl = $textarea.data('editor-medialibrary-url');

    $textarea.redactor({
        fileUpload: apiUrl + '&redactor=file',
        imageUpload: apiUrl + '&redactor=image',
    });
}

export default init;
export { initializeEditor };
