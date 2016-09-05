import '../redactor/redactor/redactor.js';
import '../redactor/langs/nl.js';
import '../redactor/plugins/imagemanager.js';
import '../redactor/plugins/video.js';

function init() {
    $('[data-editor]').each(function () {
        initializeEditor($(this));
    });
}

function initializeEditor($textarea) {
    const apiUrl = $textarea.data('editor-medialibrary-url');

    function triggerChange() {
        $textarea.trigger('change'); //trigger change for sisyphus script
    }

    $textarea.redactor({
        pastePlainText: true,
        imageUpload: apiUrl + '?redactor=true',
        imageManagerJson: apiUrl,
        buttons: ['html', 'formatting', 'bold', 'italic', 'unorderedlist', 'orderedlist', 'outdent', 'indent', 'link', 'image'],
        formatting: ['p', 'h2', 'h3', 'blockquote'],
        lang: 'nl',
        plugins: ['imagemanager', 'video'],
        changeCallback: triggerChange,
        codeKeydownCallback: triggerChange,
    });
}

export default init;
export { initializeEditor };
