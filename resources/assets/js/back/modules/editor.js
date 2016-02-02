require('../redactor/redactor/redactor.js');
require('../redactor/langs/nl.js');
require('../redactor/plugins/imagemanager.js');
require('../redactor/plugins/video.js');

$(function () {
    $('[data-editor]').each(function () {
        var $textarea = $(this);
        var apiUrl = $textarea.data('redactor-medialibrary-url');

        function triggerChange() {
            $textarea.trigger('change'); //trigger change for sisyphus script
        }

        $textarea.redactor({
            imageUpload: apiUrl + '?redactor=true',
            imageManagerJson: apiUrl,
            formatting: ['p', 'h1', 'h2', 'h3', 'blockquote'],
            lang: 'nl',
            plugins: ['imagemanager', 'video'],
            changeCallback: triggerChange,
            codeKeydownCallback: triggerChange,
        });
    });
});
