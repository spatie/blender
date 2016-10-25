import 'browsernizr/test/css/animations';
import 'browsernizr/test/css/transforms3d';
import 'browsernizr/test/svg';
import 'browsernizr/test/touchevents';
import 'browsernizr';
import './ui/srcset';

import webfont from 'webfontloader';

webfont.load({
    custom: {
        families: ['FontAwesome'],
        urls: ['/fonts/font-awesome/css/font-awesome.min.css'],
        testStrings: {
            FontAwesome: '\ue800',
        },
    },
});
