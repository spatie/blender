import $ from 'jquery';

let resizeTimer;

function updateSrcSetSize() {
    $('.js-srcset').each(function () {
        $(this).attr('sizes', $(this).width() + 'px');
    });
}

$(document).ready(() => {
    updateSrcSetSize();
});

$(window).resize(() => {
    clearTimeout(resizeTimer);

    resizeTimer = setTimeout(() =>{
        updateSrcSetSize();

    }, 250);
});
