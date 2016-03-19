(function(){
    'use strict';

    angular
        .module('ui.flexnav')
        .run([
            '$templateCache',
            function($templateCache) {
                $templateCache.put('flexnav/sub_menu.tpl',
                    '<li id="{{menu.id}}" ng-style="{width:navWidth}" ng-class="{\'item-with-ul\':menu.children && menu.children.length>0, \'flexnav-show\':menu.show}">'+
                        '<span class="submenu-visual-container" ng-mouseover="submenuOver()" ng-mouseleave="submenuLeave()"><a href="{{options.basePath+\'/\'+menu.id}}" title="{{ menu.title }}" ng-style="getStyle()" ng-click="options.onItemClick($event, menu)">{{ menu.title }}</a>'+
                        '<span ng-if="menu.children && menu.children.length>0" ng-style="{\'color\':(menu.isSection?navStyle.sectionFontColor:navStyle.menuFontColor)}" class="touch-button" ng-click="onSubmenuClicked(menu, $event)">'+
                        '<i ng-if="level==0||!lgScreen" class="fa fa-angle-down"></i>'+
                        '<i ng-if="level>0&&lgScreen" class="fa fa-angle-right"></i>'+
                        '</span></span>'+
                        '<ul ng-if="menu.children && menu.children.length>0">'+
                        '<ui-flexnav-submenu ng-repeat="item in menu.children" menu="item" nav-style="navStyle" level="childrenLevel" siblings="menu.children" lg-screen="lgScreen"></ui-flexnav-submenu>'+
                        '</ul>'+
                        '</li>'
                )
            }
        ]);
})();