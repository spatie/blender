
// Gulp settings
var config = {

    disableNotifier : false,

    app : {
        name: 'Blender 5',
        description: 'Blender 5',
        url: 'https://blender.spatie.be',
        dev: 'http://blender.192.168.10.10.xip.io'
    },

    paths : {
        node : 'node_modules/',
        fonts: 'public/fonts/',
        css : {
            resources : 'resources/assets/css/',
            public : 'public/css/'
        },
        favicons : {
            resources: 'resources/assets/favicon/500x500.png',
            public: 'public/',
            view: 'resources/views/front/layout/_partials/favicons.blade.php'
        },
        svg : {
            resources: 'resources/assets/svg/',
            public: 'public/images/svg/'
        },
        js : {
            resources: 'resources/assets/js/',
            public: 'public/js/'
        },
        relativeRoot : '././' //styles/script start from resources/js, resources/css, this one jumps to project root
    }

};


// Which sets to combine for css, js head and js defer
var files = {
        front : {
            sass : 'front/front.scss',
            css : [
                config.paths.node + 'normalize-css/normalize.css',
                config.paths.css.resources + 'front.css'
            ],
            js : ['app.js']
        },

        back : {
            sass : 'back/back.scss',
            css : [
                config.paths.node + 'normalize-css/normalize.css',
                config.paths.node + 'datatables/media/css/jquery.dataTables.css',
                config.paths.node + 'jquery-confirm/css/jquery-confirm.css',
                config.paths.node + 'select2/dist/css/select2.css',
                config.paths.css.resources + 'back.css'
            ],
            js : ['app.js', 'chart.js']

        }
};

module.exports = {
    config : config,
    files : files
};
