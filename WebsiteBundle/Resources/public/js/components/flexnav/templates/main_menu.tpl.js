(function(){
    'use strict';

    angular
        .module('ui.flexnav')
        .run([
            '$templateCache',
            function($templateCache) {
                $templateCache.put('flexnav/main_menu.tpl',
                    '<div class="flexnav-menu" ng-style="{width:vm.totalWidth}" >'+
                        '<div ng-class="vm.options.buttonClass" ng-style="vm.getStyle()" ng-mouseover="vm.menuOver()" ng-mouseleave="vm.menuLeave()">'+
                        '<span>{{menu.title}}</span>'+
                        '<span ng-if="vm.menu.children && vm.menu.children.length>0" class="touch-button" ng-click="vm.toggleMobileMenu()">'+
                        '<i class="fa fa-bars"></i>'+
                        '</span>'+
                        '</div>'+
                        '<nav>'+
                        '<ul class="flexnav with-js" ng-class="{\'lg-screen\':vm.lgScreen, \'sm-screen\':!vm.lgScreen, \'flexnav-show\':vm.mobileOpen}">'+
                        '<ui-flexnav-submenu ng-repeat="item in vm.menu.children" menu="item" level="vm.level" nav-style="vm.navStyle" siblings="vm.menu.children" nav-width="vm.navWidth" lg-screen="vm.lgScreen"></ui-flexnav-submenu>'+
                        '</ul>'+
                        '</nav>'+
                        '<div style="clear: both;"></div>'+
                        '</div>'
                )
            }
        ]);
})();