(function() {
    'use strict';
    angular
        .module('app',
            [
                'ngSanitize',
                'ui.resizer',
                'ngFileUpload',
                'website.constants',
                'components.utilities',
                'blocks.httpInterceptor',
                'blocks.router',
                'ui.tree',
                'mgcrea.ngStrap',
                'ui.tinymce',
                'ui.resourcePicker',
                'wxy.pushmenu',
                'ui.flexnav',
                'bs.colorpicker'
            ]
        );
})();