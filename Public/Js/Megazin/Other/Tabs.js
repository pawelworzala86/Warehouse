angular.module('Megazin')

    .factory('getTemplate', function ($http) {
        return {
            get: function (templateUrl, callback) {
                $http.get(templateUrl).then(callback);
            }
        }
    })

    .directive('tabs', function ($compile, $templateCache, $http, getTemplate) {
        return {
            restrict: 'E',
            scope: {
                tabsNames: '=tabs',
                data: '=data'
            },
            link: function (scope, element, attrs) {
                var tabs = [];
                var removeActive = function () {
                    angular.forEach(tabs, function (value, key) {
                        angular.element(value).removeClass("active");
                    });
                };
                var openTab = function (tabId) {
                    var tabsContents = document.querySelectorAll('tab.content');
                    angular.forEach(tabsContents, function (value, key) {
                        angular.element(value).addClass("hide");
                        if (angular.element(value).attr('tab-id') == tabId) {
                            angular.element(value).removeClass("hide");
                        }
                    });
                };
                var buttons = angular.element(document.createElement('div'));
                buttons.addClass('buttons');
                angular.forEach(scope.tabsNames, function (value, key) {
                    var idVisibleHTml = '';
                    if (value.idRequired) {
                        idVisibleHTml = ' ng-class="{\'disable\': !$parent.data.id}" ';
                    }
                    var tab = angular.element('<tab ' + idVisibleHTml + ' class="tab" tab-id="' + value.id + '" name="' + value.name + '">' + value.name + '</tab>');
                    tab.data('name', value.name);
                    tab.bind('click', function ($event) {
                        var elem = angular.element($event.target);
                        if (elem.hasClass('disable')) {
                            return;
                        }
                        removeActive();
                        elem.addClass('active');
                        openTab(elem.attr('tab-id'));
                    });
                    if (value.disable) {
                        tab.addClass('disable');
                    }
                    $compile(tab)(scope);
                    tabs.push(tab);
                    buttons.append(tab);
                });
                element.prepend(buttons);
                angular.forEach(scope.tabsNames, function (value, key) {
                    var templateUrl = value.templateUrl;
                    if (templateUrl) {
                        getTemplate.get(templateUrl, function (response) {
                            var tab = angular.element('<tab tab-id="' + value.id + '">' + response.data + '</tab>');
                            tab.addClass('content');
                            element.append(tab);
                            $compile(tab)(scope);
                            openTab(tabs[0].attr('tab-id'));
                        });
                    } else {
                        openTab(tabs[0].attr('tab-id'));
                    }
                });
                tabs[0].addClass('active');
            }
        }
    })