(function () {
    'use strict';

    angular
        .module('components.utilities')
        .factory('utilityFunctions', function(){

            var service = {
                'deepGetValue' : deepGetValue,
                'deepSetValue' : deepSetValue,
                'isDefinedNotNull' : isDefinedNotNull,
                'isNotBlank' : isNotBlank,
                'validURL' : validURL
            };

            return service;
            ////////////////////////////////

            //Dynamic deep get for a JavaScript object
            function deepGetValue() {
                var o = object;
                path = path.replace(/\[(\w+)\]/g, '.$1');
                path = path.replace(/^\./, '');
                var a = path.split('.');
                while (a.length) {
                    var n = a.shift();
                    if (n in o) {
                        o = o[n];
                    } else {
                        return;
                    }
                }
                return o;
            }

            //Dynamic deep set for a JavaScript object
            function deepSetValue(object, path, value) {
                var a = path.split('.');
                var o = object;
                for (var i = 0; i < a.length - 1; i++) {
                    var n = a[i];
                    if (n in o) {
                        o = o[n];
                    } else {
                        o[n] = {};
                        o = o[n];
                    }
                }
                o[a[a.length - 1]] = value;
            }

            //Test if value is defined and not null
            function isDefinedNotNull(value) {
                return angular.isDefined(value)&&value!=null;
            }

            function isNotBlank(value) {
                return this.isDefinedNotNull(value)&&value.trim()!='';
            }

            function validURL(value) {
                var pattern = /\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'".,<>?«»“”‘’]))/i;

                return pattern.test(value);
            }
        }
    ).directive('iframeHeightOnLoad', function(){
            return {
                restrict: 'A',
                link: function(scope, element, attrs){
                    element.on('load', function(){
                        /* Set the dimensions here,
                         I think that you were trying to do something like this: */
                        var iFrameHeight = 500;
                        try{
                            iFrameHeight = element[0].contentWindow.document.body.scrollHeight + 20 + 'px';
                        } catch(err){}
                        var iFrameWidth = '100%';
                        element.css('width', iFrameWidth);
                        element.css('height', iFrameHeight);

                        scope.$apply();
                    })
                }
            }}
        );
})();