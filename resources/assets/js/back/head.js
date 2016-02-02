import menu from './modules/menu';
import webfont from 'webfontloader';
import 'browsernizr/test/css/animations';
import 'browsernizr/test/css/transforms3d';
import 'browsernizr/test/svg';
import 'browsernizr/test/touchevents';
import 'browsernizr';

$(document).ready(function(){
    menu.init();
});

webfont.load({
    custom: {
        families: ['FontAwesome'],
        urls: ['/fonts/font-awesome/css/font-awesome.min.css'],
        testStrings: {
            FontAwesome: '\ue800',
        },
    },
});
