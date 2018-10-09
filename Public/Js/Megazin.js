var base = '';
var apiBase = '/api';
var templateBase = '/Public/Template/Pl-pl/';

angular.module('Megazin', ['ngRoute', 'ui.tree', 'ngFileUpload'])

    .config(function ($routeProvider, $locationProvider, $compileProvider, $httpProvider) {
        $routeProvider
            .when(base + '/', {
                templateUrl: templateBase + 'Landing.html',
                controller: 'landingController',
            })
            .when(base + '/konto/rejestracja', {
                templateUrl: templateBase + 'User/Register.html',
                controller: 'registerController',
            })
            .when(base + '/konto/zarejestrowano', {
                templateUrl: templateBase + 'User/AfterRegister.html',
                controller: 'afterRegisterController',
            })
            .when(base + '/konto/:code/aktywuj/:confirmationCode', {
                templateUrl: templateBase + 'User/AccountActivate.html',
                controller: 'accountActivateController',
            })
            .when(base + '/konto/logowanie', {
                templateUrl: templateBase + 'User/Login.html',
                controller: 'loginController',
            })
            .when(base + '/katalog/kategorie', {
                templateUrl: templateBase + 'Catalog/Categories.html',
                controller: 'catalogCategoriesController',
                pageName: 'Kategorie produktów',
            })
            .when(base + '/katalog/produkty', {
                templateUrl: templateBase + 'Catalog/Products.html',
                controller: 'catalogProductsController',
                pageName: 'Lista produktów',
            })
            .when(base + '/katalog/produkt/dodaj', {
                templateUrl: templateBase + 'Catalog/AddProduct.html',
                controller: 'catalogEditProductController',
                pageName: 'Dodawanie produktu',
            })
            .when(base + '/katalog/produkt/:id', {
                templateUrl: templateBase + 'Catalog/AddProduct.html',
                controller: 'catalogEditProductController',
                pageName: 'Edycja produktu',
            })
            .when(base + '/konto/profil', {
                templateUrl: templateBase + 'User/Profile.html',
                controller: 'userProfilController',
                pageName: 'Profil użytkownika',
            })
            .when(base + '/system/pliki', {
                templateUrl: templateBase + 'System/Files.html',
                controller: 'systemFilesController',
                pageName: 'Twoje pliki',
            })
            .when(base + '/dokumenty', {
                templateUrl: templateBase + 'Documents.html',
                controller: 'documentsController',
                pageName: 'Lista dokumentów',
            })
            .when(base + '/dokument/dodaj', {
                templateUrl: templateBase + 'Document-Edit.html',
                controller: 'documentEditController',
                pageName: 'Edycja dokumentu',
            })
            .when(base + '/dokument/:id', {
                templateUrl: templateBase + 'Document-Edit.html',
                controller: 'documentEditController',
                pageName: 'Edycja dokumentu',
            })
            .when(base + '/dokument/dodaj/produkcja/:productionId/:type', {
                templateUrl: templateBase + 'Document-Edit.html',
                controller: 'documentEditController',
                pageName: 'Wydanie na produkcję',
            })
            .when(base + '/kontrahenci', {
                templateUrl: templateBase + 'Contractors.html',
                controller: 'contractorsController',
                pageName: 'Lista kontrahentów',
            })
            .when(base + '/kontrahent/dodaj', {
                templateUrl: templateBase + 'Contractor-Edit.html',
                controller: 'contractorEditController',
                pageName: 'Edycja kontrahenta',
            })
            .when(base + '/kontrahent/:id', {
                templateUrl: templateBase + 'Contractor-Edit.html',
                controller: 'contractorEditController',
                pageName: 'Edycja kontrahenta',
            })
            .when(base + '/magazyn', {
                templateUrl: templateBase + 'Stocks.html',
                controller: 'stocksController',
                pageName: 'Stan towarów',
            })
            .when(base + '/zamowienia', {
                templateUrl: templateBase + 'Orders.html',
                controller: 'ordersController',
                pageName: 'Lista zamówień',
            })
            .when(base + '/zamowienie/dodaj', {
                templateUrl: templateBase + 'Order-Edit.html',
                controller: 'orderEditController',
                pageName: 'Dodawanie zamówienia',
            })
            .when(base + '/zamowienie/:id', {
                templateUrl: templateBase + 'Order-Edit.html',
                controller: 'orderEditController',
                pageName: 'Edycja zamówienia',
            })
            .when(base + '/dluznicy', {
                templateUrl: templateBase + 'Debtors.html',
                controller: 'debtorsController',
                pageName: 'Lista dłużników',
            })
            .when(base + '/produkcje', {
                templateUrl: templateBase + 'Productions.html',
                controller: 'productionsController',
                pageName: 'Lista produkcji',
            })
            .when(base + '/produkcja/dodaj', {
                templateUrl: templateBase + 'Production-Edit.html',
                controller: 'productionEditController',
                pageName: 'Dodawanie produkcji',
            })
            .when(base + '/produkcja/:id', {
                templateUrl: templateBase + 'Production-Edit.html',
                controller: 'productionEditController',
                pageName: 'Edycja produkcji',
            })
            .when(base + '/kasa', {
                templateUrl: templateBase + 'Cash.html',
                controller: 'cashsController',
                pageName: 'Stan kasy',
            })
            .when(base + '/kasa/dodaj', {
                templateUrl: templateBase + 'Cash-Edit.html',
                controller: 'cashEditController',
                pageName: 'Edycja dokumentu kasowego',
            })
            .when(base + '/kasa/:id', {
                templateUrl: templateBase + 'Cash-Edit.html',
                controller: 'cashEditController',
                pageName: 'Edycja dokumentu kasowego',
            })
            .when(base + '/kanaly-sprzedazy', {
                templateUrl: templateBase + 'Channels.html',
                controller: 'channelsController',
                pageName: 'Kanały sprzedaży',
            })
            .when(base + '/kanal-sprzedazy/dodaj', {
                templateUrl: templateBase + 'Channel-Edit.html',
                controller: 'channelEditController',
                pageName: 'Edycja kanału sprzedaży',
            })
            .when(base + '/kanal-sprzedazy/:id', {
                templateUrl: templateBase + 'Channel-Edit.html',
                controller: 'channelEditController',
                pageName: 'Edycja kanału sprzedaży',
            })
        ;

        $locationProvider.html5Mode({
            enabled: true,
            requireBase: false
        });
        $compileProvider.debugInfoEnabled(true);
        delete $httpProvider.defaults.headers.common['X-Requested-With'];
        $httpProvider.defaults.useXDomain = true;
        $httpProvider.defaults.withCredentials = true;
    })

    .run(function ($rootScope, $http, $location, $route) {
        $rootScope.showFilter = false;
        $rootScope.showMenu = false;
        $rootScope.pageName = null;
        $rootScope.baseUrl = base;
        $rootScope.logout = function () {
            $http.get(apiBase + '/user/logout').then(function (response) {
                if (response.data.success) {
                    $rootScope.user.logged = false;
                    $location.path('/');
                }
            });
        }
        $http.get(apiBase + '/user/status').then(function (response) {
            $rootScope.user = {
                logged: response.data.logged,
            };
        });
        $rootScope.$on('$routeChangeStart', function ($event, next, current) {
            $rootScope.selects = []
            $rootScope.filters = [];
            $rootScope.filtersNames = [];
            if (next.hasOwnProperty('$$route') && !next['$$route'].pageName) {
                return;
            }
            $rootScope.pageName = next['$$route'].pageName;
        });
        $rootScope.formatSizeUnits = function (bytes) {
            if (bytes >= 1073741824) {
                bytes = (bytes / 1073741824).toFixed(2) + ' GB';
            }
            else if (bytes >= 1048576) {
                bytes = (bytes / 1048576).toFixed(2) + ' MB';
            }
            else if (bytes >= 1024) {
                bytes = (bytes / 1024).toFixed(2) + ' KB';
            }
            else if (bytes > 1) {
                bytes = bytes + ' b';
            }
            else if (bytes == 1) {
                bytes = bytes + ' b';
            }
            else {
                bytes = '0 b';
            }
            return bytes;
        }
        var original = $location.path;
        $location.path = function (path, reload) {
            if (reload === false) {
                var lastRoute = $route.current;
                var un = $rootScope.$on('$locationChangeSuccess', function () {
                    $route.current = lastRoute;
                    un();
                });
            }
            return original.apply($location, [path]);
        };
    })

    .controller('systemFilesController', function (modalDialog, $rootScope, $scope, getFiles, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        var filters = [];
        var filtersNames = [];
        $scope.files = [];
        $rootScope.filters = filters;
        $scope.filters = {
            name: '',
            type: '',
            size: '',
        }
        var getData = function (pagination, data) {
            if (data && (data.length > 0)) {
                return data;
            }
            return pagination
        }
        var loadPage = function () {
            getFiles.get(function (response) {
                angular.forEach(response.data.files, function (value, key) {
                    $scope.files.push(value);
                });
                pagination = getData(pagination, response.data.pagination);
                filters = getData(filters, response.data.filters);
                filtersNames = getData(filtersNames, response.data.filtersNames);
                $rootScope.filters = filters;
                $rootScope.filtersNames = filtersNames;
            }, pagination, $rootScope.filters);
        }
        $scope.deleteRow = function (rows, row) {
            deleteDialog.show($scope, {
                title: 'Usunięcie pliku',
                data: {
                    rows: rows,
                    row: row,
                    id: row.id,
                    apiUrl: '/system/files'
                },
            });
        }
        $scope.fluentLoad = function () {
            pagination.page++;
            loadPage();
        }
        loadPage();
        $rootScope.filterRefreshCallback = function () {
            $scope.products = [];
            pagination.page = 1;
            loadPage();
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.name) {
                $rootScope.filters.push({
                    name: 'name',
                    kind: '%',
                    value: $scope.filters.name,
                })
            }
            if ($scope.filters.type) {
                $rootScope.filters.push({
                    name: 'type',
                    kind: '%',
                    value: $scope.filters.type,
                })
            }
            if ($scope.filters.size) {
                $rootScope.filters.push({
                    name: 'type',
                    kind: '%',
                    value: $scope.filters.size,
                })
            }
            $scope.files = [];
            pagination.page = 1;
            loadPage()
        }
    })

    .factory('getFiles', function ($http, $httpParamSerializerJQLike) {
        return {
            get: function (callback, pagination, filters) {
                var pagin = $httpParamSerializerJQLike({pagination: pagination});
                var filt = $httpParamSerializerJQLike({filters: filters});
                if (pagin) {
                    pagin += '&';
                }
                $http.get(apiBase + '/system/files?' + pagin + filt).then(callback);
            }
        }
    })

    .controller('userProfilController', function ($scope, userProfil, $http) {
        $scope.data = {
            profile: {}
        }
        userProfil.get(function (response) {
            $scope.data.profile = response.data
        })
        $scope.data.send = () => {
            $http.post(apiBase + '/user/profile', $scope.data.profile, (response) => {
            })
        }
    })

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

    .factory('showError', function (modalDialog) {
        return {
            show: function (scope, message) {
                modalDialog.show(scope, {
                    title: '',
                    templateUrl: '/Public/Template/Pl-pl/ErrorDialog.html',
                    data: {
                        message: message
                    }
                })
            }
        }
    })

    .controller('landingController', function ($scope) {
    })

    .controller('selectTableController', function (modalDialog, $rootScope, $scope, deleteDialog, $http) {
        $rootScope.selects = [];
        $scope.setSelectOptions = function (deleteUrl, titleField, itemsName) {
            $scope.deleteUrl = deleteUrl;
            $scope.titleField = titleField;
            $scope.itemsName = itemsName;
        }
        var removeFromSelect = function (index, row) {
            $rootScope.selects.splice(index, 1);
            var element = angular.element(document.querySelector('#chbx' + row.id));
            element.prop('checked', false);
            row.selected = false;
        }
        var removeFromRows = function (index, rows) {
            rows[index].selected = false;
        }
        var addToSelect = function (row) {
            var data = {
                id: row.id,
                name: row[$scope.titleField],
            }
            $rootScope.selects.push(data);
            var element = angular.element(document.querySelector('#chbx' + row.id));
            element.prop('checked', true);
            row.selected = true;
        }
        var findInSelect = function (rows, row) {
            var index = -1;
            angular.forEach(rows, function (value, key) {
                if (value.id == row.id) {
                    index = key;
                }
            });
            return index;
        }
        var addOrRemove = function (row) {
            var index = findInSelect($rootScope.selects, row);
            if (index < 0) {
                if (!row.deleted) {
                    addToSelect(row);
                }
            } else {
                removeFromSelect(index, row);
            }
        }
        $scope.checkAll = function (array) {
            angular.forEach(array, function (value, key) {
                addOrRemove(value);
            });
        }
        $scope.check = function (row) {
            addOrRemove(row);
        }
        $scope.delSelect = function (row, rows) {
            var index = findInSelect($rootScope.selects, row);
            removeFromSelect(index, row);
            var index = findInSelect(rows, row);
            if (index > -1) {
                rows[index].selected = false;
            }
        }
        $scope.clear = function (rows) {
            angular.forEach(rows, function (value, key) {
                if (value.selected) {
                    value.deleted = true;
                }
            });
        }
        $scope.massXls = function (rows) {
            var data = [];
            angular.forEach(rows, function (value, key) {
                data.push(value.id);
            });
            $http.post(apiBase + $scope.deleteUrl + '/mass/xls', {ids: data}).then(function (response) {
                var anchor = angular.element('<a/>');
                anchor.attr({
                    href: response.data.url,
                    target: '_blank',
                    download: response.data.name
                })[0].click();
            });
        }
        $scope.massPdf = function (rows) {
            var data = [];
            angular.forEach(rows, function (value, key) {
                data.push(value.id);
            });
            $http.post(apiBase + $scope.deleteUrl + '/mass/pdf', {ids: data}).then(function (response) {
                var anchor = angular.element('<a/>');
                anchor.attr({
                    href: response.data.url,
                    target: '_blank',
                    download: response.data.name
                })[0].click();
            });
        }
        $scope.massDelete = function (rows, row) {
            deleteDialog.show($scope, {
                title: 'Usunięcie wielu pozycji',
                data: {
                    rows: rows,
                    row: row,
                    apiUrl: $scope.deleteUrl
                },
            });
        }
        $scope.loadDetail = (url, products, product, template = null) => {
            //product.detail = true
            $http.get(apiBase + url + '/' + product.id).then(function (response) {
                //product.detail = response.data
                let dialogTemplate = url.substring(1)
                dialogTemplate = dialogTemplate.charAt(0).toUpperCase() + dialogTemplate.substring(1)
                if (template) {
                    //template = url.substring(1)
                    template = template.charAt(0).toUpperCase() + template.substring(1)
                }
                modalDialog.show($scope, {
                    title: '',
                    templateUrl: '/Public/Template/Pl-pl/' + (template ? template : dialogTemplate) + 'Dialog.html',
                    data: response.data
                })
            });
        }
        $scope.saveDetail = (url, detailRow) => {
            //product.detail = true
            $http.put(apiBase + url + '/' + detailRow.id, detailRow).then(function (response) {
                $scope.$parent.reload(detailRow)
            });
        }
    })

    .factory('modalDialog', ($http, $compile, $rootScope) => {
        return {
            show: (scopeFrom, options) => {
                if (!$rootScope.modalIndex) {
                    $rootScope.modalIndex = 100000
                }
                $rootScope.modalIndex++
                $http.get(options.templateUrl).then((response) => {
                    var node = angular.element(response.data)
                    var scope = scopeFrom.$new()
                    scope.modal = {}
                    scope.modal.close = () => {
                        node.remove()
                        angular.element(document.body).removeClass('modal')
                    }
                    scope.modal.title = options.title
                    scope.modal.message = options.title
                    if (options.accept) {
                        scope.modal.accept = () => {
                            angular.element(document.body).removeClass('modal')
                            options.accept(scope.data, node)
                        }
                    }
                    if (options.data) {
                        scope.data = options.data
                    }
                    scope.modal.zIndex = $rootScope.modalIndex
                    $compile(node.contents())(scope)
                    angular.element(document.body).append(node)
                    angular.element(document.body).addClass('modal')
                })
            }
        }
    })

    .factory('modalError', (modalDialog, $http, $compile, $rootScope) => {
        return {
            show: (scope, title) => {
                modalDialog.show(scope, {
                    title: title,
                    templateUrl: '/Public/Template/Pl-pl/ErrorDialog.html',
                })
            }
        }
    })

    .controller('catalogCategoriesController', function (modalError, modalDialog, showError, $scope, $http, catalogCategories, deleteDialog) {
        $scope.categories = [];
        catalogCategories.get(function (response) {
            $scope.categories = response.data.categories ? response.data.categories : [];
        })
        $scope.add = function (item, items) {
            modalDialog.show($scope, {
                title: 'Dodawanie nowej kategorii do katalogu',
                templateUrl: '/Public/Template/Pl-pl/Catalog/AddCategoryDialog.html',
                accept: (data, node) => {
                    if (!data || !data.name) {
                        modalError.show($scope, 'Wprowadź nazwę kategorii')
                        return
                    }
                    $http.post(apiBase + '/catalog/category', data).then(function (response) {
                        $scope.categories.push({
                            id: response.data.id,
                            name: data.name,
                            parentId: data.parentId,
                            categories: [],
                        });
                        node.remove()
                    });
                }
            })
        }
        $scope.treeOptions = {
            beforeDrop: function (event) {
                var index = event.dest.index;
                var categoryId = event.source.nodeScope.$modelValue.id;
                var name = event.source.nodeScope.$modelValue.name;
                var parentId = null;
                if (event.dest.nodesScope.$parent.$modelValue) {
                    parentId = event.dest.nodesScope.$parent.$modelValue.id;
                }
                $http.put(apiBase + '/catalog/category/' + categoryId, {
                    name: name,
                    lp: index + 1,
                    parentId: parentId,
                }).then(function (response) {
                });
                return true;
            },
        };
        $scope.edit = function (element) {
            modalDialog.show($scope, {
                title: 'Dodawanie nowej kategorii do katalogu',
                templateUrl: '/Public/Template/Pl-pl/Catalog/AddCategoryDialog.html',
                data: element,
                accept: (data, node) => {
                    $http.put(apiBase + '/catalog/category/' + element.id, {
                        id: data.id,
                        name: data.name,
                        parentId: data.parentId,
                    }).then(function (response) {
                        element.name = data.name;
                        node.remove()
                    });
                }
            })
        }
    })

    .factory('deleteDialog', function ($http, modalDialog, $rootScope) {
        return {
            show: function (scope, options) {
                modalDialog.show(scope, {
                    title: options['title'] ? options.title : '',
                    templateUrl: '/Public/Template/Pl-pl/DeleteDialog.html',
                    data: options.data,
                    accept: (data, node) => {
                        if (data.id) {
                            $http.delete(apiBase + data.apiUrl + '/' + data.id, {id: data.id}).then(function (response) {
                                if (response.data.success) {
                                    node.remove()
                                    if (data.row) {
                                        data.row.deleted = true
                                    }
                                }
                            });
                        } else {
                            var ids = [];
                            angular.forEach($rootScope.selects, function (value, key) {
                                ids.push(value.id);
                            });
                            $http.post(apiBase + data.apiUrl + '/mass/delete', {ids: ids}).then(function (response) {
                                if (response.data.success) {
                                    angular.forEach(data.rows, function (value, key) {
                                        angular.forEach(data.row, function (v, k) {
                                            if (v.id == value.id)
                                                value.deleted = true
                                        })
                                    })
                                    node.remove()
                                    $rootScope.selects = []
                                }
                            });
                        }
                    }
                })
            }
        }
    })

    .controller('catalogEditProductController', function (showError, $routeParams, $scope, $http, $location, catalogProduct, $compile) {
        $scope.data = {
            id: $routeParams.id,
            product: {
                toSell: true,
                vat: '23'
            },
            validation: {
                sku: true,
                name: true,
                sellNet: true,
                sellGross: true,
                vat: true,
            }
        }
        $scope.data.vatRates = [
            {
                name: '23%',
                value: 23
            },
            {
                name: '8%',
                value: 8
            },
            {
                name: '5%',
                value: 5
            },
            {
                name: '0%',
                value: 0
            },
            {
                name: 'zw',
                value: 0
            }
        ]
        if ($routeParams.id) {
            catalogProduct.get(function (response) {
                $scope.data.product = response.data;
                $scope.data.product.vat = $scope.data.product.vat + ''
            }, $routeParams.id);
        }
        $scope.data.send = function () {
            $scope.data.validation.name = $scope.data.product.name ? false : true
            $scope.data.validation.sku = $scope.data.product.sku ? false : true
            $scope.data.validation.sellNet = $scope.data.product.sellNet ? false : true
            $scope.data.validation.sellGross = $scope.data.product.sellGross ? false : true
            $scope.data.validation.vat = $scope.data.product.vat ? false : true
            validate = true
            angular.forEach($scope.data.validation, (el) => {
                if (el) {
                    validate = false
                }
            })
            if (!validate) {
                if ($scope.data.validation.sku) {
                    showError.show($scope, 'Wprowadź kod SKU')
                } else if ($scope.data.validation.name) {
                    showError.show($scope, 'Wprowadź nazwę towaru')
                } else if ($scope.data.validation.sellNet) {
                    showError.show($scope, 'Wprowadź cenę sprzedaży netto')
                } else if ($scope.data.validation.sellGross) {
                    showError.show($scope, 'Wprowadź cenę sprzedaży brutto')
                } else if ($scope.data.validation.vat) {
                    showError.show($scope, 'Wybierz stawkę VAT')
                }
                return
            }
            var data = $scope.data.product;
            if ($routeParams.id) {
                $http.put(apiBase + '/catalog/product/' + $routeParams.id, data).then(function (response) {
                    if (response.data.success) {
                        //$location.path('/katalog/produkty');
                    }
                });
                //$scope.messages = response.data.errors
            } else {
                $http.post(apiBase + '/catalog/product', data).then(function (response) {
                    if (response.data.id) {
                        $scope.data.id = response.data.id;
                        $location.path('/katalog/produkt/' + response.data.id, false);
                    }
                    //$scope.messages = response.data.errors
                });
            }
        }
        $scope.tabs = [
            {id: 1, name: 'Podstawowe', templateUrl: '/Public/Template/Pl-pl/Catalog/Product/CardBasic.html'},
            {id: 2, name: 'Ceny', templateUrl: '/Public/Template/Pl-pl/Catalog/Product/CardPrice.html'},
            {id: 3, name: 'Opisy', templateUrl: '/Public/Template/Pl-pl/Catalog/Product/CardDescription.html'},
            {
                id: 4,
                name: 'Zdjęcia',
                templateUrl: '/Public/Template/Pl-pl/Catalog/Product/CardPhotos.html',
                idRequired: true
            },
            {
                id: 5,
                name: 'Załączniki',
                templateUrl: '/Public/Template/Pl-pl/Catalog/Product/CardAttachments.html',
                idRequired: true
            },
            {id: 6, name: 'Dostawcy', disable: true}
        ];
        $scope.imagesUploadOptions = {}
        $scope.attachmentsUploadOptions = {}
        buyCalcBlock = false
        $scope.data.sellCalc = (fromNet = false) => {
            buyCalcBlock = true
            if (fromNet) {
                if (!$scope.data.product.sellNet) {
                    sellCalcBlock = false
                    return
                }
                net = parseFloat(('' + $scope.data.product.sellNet).replace(',', '.'))
                vat = $scope.data.product.vat
                vat = (100 + parseFloat(vat)) / 100
                gross = Math.round(net * vat * 100) / 100
                $scope.data.product.sellGross = gross.toFixed(2)
            } else {
                if (!$scope.data.product.sellGross) {
                    sellCalcBlock = false
                    return
                }
                gross = parseFloat(('' + $scope.data.product.sellGross).replace(',', '.'))
                vat = $scope.data.product.vat
                vat = 100 / (100 + parseFloat(vat))
                net = Math.round(gross * vat * 100) / 100
                $scope.data.product.sellNet = net.toFixed(2)
            }
            sellCalcBlock = false
        }
    })

    .controller('documentEditController', function (showError, $routeParams, $scope, $http, $location, document, contractorSearch, productSearch, stockSearch) {
        $scope.data = {
            id: $routeParams.id,
            document: {
                products: [],
                stocks: [],
                date: (date = new Date()).getFullYear() + '-' + ((month = (date.getMonth() + 1)) < 10 ? ('0' + month) : month) + '-' + date.getDate(),
                deliveryDate: (date = new Date()).getFullYear() + '-' + ((month = (date.getMonth() + 1)) < 10 ? ('0' + month) : month) + '-' + date.getDate(),
                payDate: (date = (new Date())) ? (date.setDate(date.getDate() + 14) ? (date.getFullYear() + '-' + ((month = (date.getMonth() + 1)) < 10 ? ('0' + month) : month) + '-' + date.getDate()) : '') : '',
                payment: 'money',
            },
            validation: {
                name: true,
                date: true,
                payDate: true,
                issuePlace: true,
                deliveryDate: true,
                payment: false,
            },
            contractorShow: false,
            find: {
                name: '',
                date: '',
                payDate: '',
            },
            products: [],
            stocks: [],
            productionId: $routeParams.productionId,
            cashDocument: true,
        }
        $scope.data.vatRates = [
            {
                name: '23%',
                value: '23'
            },
            {
                name: '8%',
                value: '8'
            },
            {
                name: '5%',
                value: '5'
            },
            {
                name: '0%',
                value: '0'
            },
            {
                name: 'zw',
                value: '0'
            }
        ]
        loadedType = '';
        if ($routeParams.id) {
            document.get(function (response) {
                loadedType = response.data.type
                $scope.data.document = response.data
                $scope.data.contractorId = $scope.data.document.contractorId
                if ($scope.data.document.contractorId) {
                    $http.get(apiBase + '/contractor/' + $scope.data.contractorId).then((response) => {
                        $scope.data.contractor = response.data
                    })
                }
                if (!$scope.data.document.products) {
                    $scope.data.document.products = []
                }
                angular.forEach($scope.data.document.products, (product) => {
                    product.vat = product.vat + ''
                    $scope.data.callcNet(product)
                })
                $scope.data.refreshResume()
                $scope.data.document.type = loadedType
                if($routeParams.type=='rw'){
                    $scope.data.document.kind = 'dec'
                    $scope.data.document.type = 'rw'
                }else if($routeParams.type=='pw'){
                    $scope.data.document.kind = 'add'
                    $scope.data.document.type = 'pw'
                }
                $scope.data.productionId = $routeParams.productionId
            }, $routeParams.id);
        }else{
            $http.get(apiBase+'/document/default').then((response)=>{
                $scope.data.document.issuePlace = response.data.issuePlace
                $scope.data.document.bankName = response.data.bankName
                $scope.data.document.swift = response.data.bankSwift
                $scope.data.document.bankNumber = response.data.bankNumber
            })
        }
        $scope.data.productionId = $routeParams.productionId
        if($routeParams.type=='rw'){
            $scope.data.document.kind = 'dec'
            $scope.data.document.type = 'rw'
        }
        if(($routeParams.type=='rw')||($routeParams.type=='pw')){
            $http.get(apiBase+'/production/'+$routeParams.productionId).then((response)=>{
                $scope.data.production = response.data;
            })
        }
        $scope.data.send = function () {
            $scope.data.validation.name = $scope.data.document.name ? false : true
            $scope.data.validation.date = $scope.data.document.date ? false : true
            $scope.data.validation.payDate = $scope.data.document.payDate ? false : true
            $scope.data.validation.issuePlace = $scope.data.document.issuePlace ? false : true
            $scope.data.validation.deliveryDate = $scope.data.document.deliveryDate ? false : true
            $scope.data.validation.payment = $scope.data.document.payment ? false : true
            validate = true
            angular.forEach($scope.data.validation, (el) => {
                if (el) {
                    validate = false
                }
            })
            if (!$scope.data.document.products.length > 0) {
                validate = false
            } else if (!$scope.data.contractorId&&!$scope.data.productionId) {
                validate = false
            }
            if (!validate) {
                if ($scope.data.validation.name) {
                    showError.show($scope, 'Wprowadź numer dokumentu')
                } else if ($scope.data.validation.date) {
                    showError.show($scope, 'Wprowadź datę dokumentu')
                } else if ($scope.data.validation.payDate) {
                    showError.show($scope, 'Wprowadź datę zapłaty')
                } else if ($scope.data.validation.issuePlace) {
                    showError.show($scope, 'Wprowadź miejsce wystawienia')
                } else if ($scope.data.validation.deliveryDate) {
                    showError.show($scope, 'Wprowadź datę otrzymania')
                } else if (!$scope.data.document.products.length > 0) {
                    showError.show($scope, 'Wybierz jakieś produkty')
                } else if (!$scope.data.contractorId) {
                    showError.show($scope, 'Wybierz kontrahenta')
                } else if ($scope.data.validation.payment) {
                    if ((data.document.type === 'fvp') || (data.document.type === 'fvs')) {
                        showError.show($scope, 'Wybierz metodę płatności')
                    }
                }
                return
            }
            let data = $scope.data.document
            data.contractorId = $scope.data.contractorId
            data.cashDocument = $scope.data.cashDocument
            data.productionId = $routeParams.productionId
            if (data.id) {
                $http.put(apiBase + '/document/' + data.id, data).then(function (response) {
                    if (response.data.success) {
                        //$location.path('/katalog/produkty');
                    }
                });
                //$scope.messages = response.data.errors
            } else {
                $http.post(apiBase + '/document', data).then(function (response) {
                    if (response.data.id) {
                        $scope.data.id = response.data.id;
                        $location.path('/dokument/' + response.data.id, false);
                    }
                    //$scope.messages = response.data.errors
                });
            }
        }
        $scope.data.reloadContractor = () => {
            contractorSearch.get((response) => {
                $scope.data.contractors = response.data.contractors
            }, $scope.data.find.name, $scope.data.document.kind == 'add')
        }
        $scope.data.reloadProduct = () => {
            productSearch.get((response) => {
                $scope.data.products = response.data.products
            }, $scope.data.find.name)
        }
        $scope.data.reloadStock = () => {
            stockSearch.get((response) => {
                $scope.data.stocks = response.data.stocks
            }, $scope.data.find.name)
        }
        $scope.data.selectContractor = (contractor) => {
            $scope.data.contractorId = contractor.id
            $scope.data.contractorShow = false
            $scope.data.contractor = contractor
        }
        $scope.data.showSelectContractor = () => {
            $scope.data.contractorShow = true
            $scope.data.reloadContractor()
        }
        $scope.data.contractorHide = () => {
            $scope.data.contractorShow = false
        }
        $scope.data.productHide = () => {
            $scope.data.productShow = false
        }
        $scope.data.stockHide = () => {
            $scope.data.stockShow = false
        }
        $scope.data.showSelectProduct = () => {
            $scope.data.productShow = true
            $scope.data.reloadProduct()
        }
        $scope.data.showSelectStock = () => {
            $scope.data.stockShow = true
            $scope.data.reloadStock()
        }
        //$scope.data.reloadContractor()
        //$scope.data.reloadProduct()
        //$scope.data.reloadStock()
        $scope.data.selectProduct = (product) => {
            $scope.data.productShow = false
            product.count = 1
            product.vat = product.vat + ''
            product.productId = product.id
            delete product.id
            $scope.data.document.products.push(product)
            $scope.data.callcNet(product)
            $scope.data.refreshResume()
        }
        $scope.data.selectStock = (stock) => {
            $scope.data.stockShow = false
            stock.count = 1
            stock.vat = stock.vat + ''
            stock.productId = stock.id
            delete stock.id
            $scope.data.document.products.push(stock)
            $scope.data.callcNet(stock)
            $scope.data.refreshResume()
        }
        $scope.remove = (rows, row) => {
            row.deleted = true
        }
        $scope.data.callcNet = (product) => {
            net = (product.net + '').replace ? parseFloat((product.net + '').replace(',', '.')) : 0
            count = (product.count + '').replace ? parseFloat((product.count + '').replace(',', '.')) : 0
            product.sumNet = (net * count).toFixed(2)

            vat = product.vat
            product.sumVat = ((net * count) * (product.vat / 100)).toFixed(2)

            product.sumGross = ((net * count) + ((net * count) * (product.vat / 100))).toFixed(2)
            $scope.data.refreshResume()
        }
        $scope.data.callcSumNet = (product) => {
            sumNet = (product.sumNet + '').replace ? parseFloat((product.sumNet + '').replace(',', '.')) : 0
            count = (product.count + '').replace ? parseFloat((product.count + '').replace(',', '.')) : 0
            product.net = (sumNet / count).toFixed(2)

            vat = product.vat
            product.sumVat = (sumNet * (product.vat / 100)).toFixed(2)

            product.sumGross = (sumNet + (sumNet * (product.vat / 100))).toFixed(2)
            $scope.data.refreshResume()
            //$scope.data.callcNet()
        }
        $scope.data.callcSumGross = (product) => {
            sumGross = (product.sumGross + '').replace ? parseFloat((product.sumGross + '').replace(',', '.')) : 0
            count = (product.count + '').replace ? parseFloat((product.count + '').replace(',', '.')) : 0
            vat = product.vat
            product.sumVat = ((sumGross / (100 + parseFloat(product.vat))) * parseFloat(product.vat)).toFixed(2)
            product.sumNet = (sumGross - product.sumVat).toFixed(2)
            product.net = (product.sumNet / count).toFixed(2)
            $scope.data.refreshResume()
            //$scope.data.callcNet()
        }
        $scope.data.refreshResume = () => {
            sumNet = 0
            sumGross = 0
            angular.forEach($scope.data.document.products, (product) => {
                sumNet += parseFloat(product.sumNet)
                sumGross += parseFloat(product.net) * parseFloat(product.count) * (100 + parseFloat(product.vat)) / 100
            })
            $scope.data.document.sumNet = sumNet.toFixed(2)
            $scope.data.document.sumGross = sumGross.toFixed(2)
            $scope.data.document.tax = (sumGross - sumNet).toFixed(2)
            $scope.data.refreshSummary()
        }
        $scope.data.refreshSummary = () => {
            sumGross = 0
            angular.forEach($scope.data.document.products, (product) => {
                sumGross += parseFloat(product.net) * parseFloat(product.count) * (100 + parseFloat(product.vat)) / 100
            })
            if (!$scope.data.document.payed) {
                $scope.data.document.payed = sumGross.toFixed(2)
                $scope.data.document.toPay = 0
            }
            if (!$routeParams.id) {
                $scope.data.toPayRefresh()
            }
        }
        $scope.data.payedRefresh = () => {
            sumGross = 0
            angular.forEach($scope.data.document.products, (product) => {
                sumGross += parseFloat(product.net) * parseFloat(product.count) * (100 + parseFloat(product.vat)) / 100
            })
            $scope.data.document.toPay = (sumGross - parseFloat($scope.data.document.payed)).toFixed(2)
        }
        $scope.data.toPayRefresh = () => {
            sumGross = 0
            angular.forEach($scope.data.document.products, (product) => {
                sumGross += parseFloat(product.net) * parseFloat(product.count) * (100 + parseFloat(product.vat)) / 100
            })
            $scope.data.document.payed = (sumGross - parseFloat($scope.data.document.toPay)).toFixed(2)
        }
        $scope.$watch('data.document.kind', () => {
            //$scope.data.document.type = '';
            if ($scope.data.document.kind == 'add') {
                $scope.data.typeOption = [
                    {
                        name: 'Faktura zakupu',
                        value: 'fvp',
                    },
                    {
                        name: 'PZ',
                        value: 'pz',
                    },
                    {
                        name: 'PW',
                        value: 'pw',
                    },
                ]
            } else {
                $scope.data.typeOption = [
                    {
                        name: 'Faktura sprzedaż',
                        value: 'fvs',
                    },
                    {
                        name: 'WZ',
                        value: 'wz',
                    },
                    {
                        name: 'RW',
                        value: 'rw',
                    },
                ]
            }
            //alert(loadedType)
            $scope.data.document.type = loadedType
            if($routeParams.type=='rw'){
                $scope.data.document.kind = 'dec'
                $scope.data.document.type = 'rw'
            }else if($routeParams.type=='pw'){
                $scope.data.document.kind = 'add'
                $scope.data.document.type = 'pw'
            }
        })
        $scope.$watch('data.document.type', () => {
            if (!$routeParams.id && $scope.data.document.type) {
                $http.get(apiBase + '/document/number/' + $scope.data.document.type).then((response) => {
                    $scope.data.document.name = response.data.name
                    $scope.data.document.documentNumberId = response.data.documentNumberId
                })
            }
        })
    })

    .controller('orderEditController', function (showError, $routeParams, $scope, $http, $location, order, contractorSearch, productSearch, stockSearch) {
        $scope.data = {
            id: $routeParams.id,
            document: {
                products: [],
                date: (date = new Date()).getFullYear() + '-' + ((month = (date.getMonth() + 1)) < 10 ? ('0' + month) : month) + '-' + date.getDate(),
            },
            validation: {
                name: true,
                date: true,
            },
            contractorShow: false,
            find: {
                name: '',
                date: '',
            },
            products: [],
        }
        $scope.data.vatRates = [
            {
                name: '23%',
                value: '23'
            },
            {
                name: '8%',
                value: '8'
            },
            {
                name: '5%',
                value: '5'
            },
            {
                name: '0%',
                value: '0'
            },
            {
                name: 'zw',
                value: '0'
            }
        ]
        loadedType = '';
        if ($routeParams.id) {
            order.get(function (response) {
                loadedType = response.data.type
                $scope.data.document = response.data
                $scope.data.contractorId = $scope.data.document.contractorId
                if ($scope.data.document.contractorId) {
                    $http.get(apiBase + '/contractor/' + $scope.data.contractorId).then((response) => {
                        $scope.data.contractor = response.data
                    })
                }
                if (!$scope.data.document.products) {
                    $scope.data.document.products = []
                }
                angular.forEach($scope.data.document.products, (product) => {
                    product.vat = product.vat + ''
                    $scope.data.callcNet(product)
                })
                //$scope.data.refreshResume()
                $scope.data.document.type = loadedType
            }, $routeParams.id);
        }
        $scope.data.send = function () {
            $scope.data.validation.name = $scope.data.document.name ? false : true
            $scope.data.validation.date = $scope.data.document.date ? false : true
            validate = true
            angular.forEach($scope.data.validation, (el) => {
                if (el) {
                    validate = false
                }
            })
            if (!$scope.data.document.products.length > 0) {
                validate = false
            } else if (!$scope.data.contractorId) {
                validate = false
            }
            if (!validate) {
                if ($scope.data.validation.name) {
                    showError.show($scope, 'Wprowadź numer dokumentu')
                } else if ($scope.data.validation.date) {
                    showError.show($scope, 'Wprowadź datę dokumentu')
                } else if (!$scope.data.document.products.length > 0) {
                    showError.show($scope, 'Wybierz jakieś produkty')
                } else if (!$scope.data.contractorId) {
                    showError.show($scope, 'Wybierz kontrahenta')
                }
                return
            }
            var data = $scope.data.document
            data.contractorId = $scope.data.contractorId
            if ($routeParams.id) {
                $http.put(apiBase + '/orders/' + $routeParams.id, data).then(function (response) {
                    if (response.data.success) {
                        //$location.path('/katalog/produkty');
                    }
                });
                //$scope.messages = response.data.errors
            } else {
                $http.post(apiBase + '/orders', data).then(function (response) {
                    if (response.data.id) {
                        $scope.data.id = response.data.id;
                        $location.path('/zamowienie/' + response.data.id, false);
                    }
                    //$scope.messages = response.data.errors
                });
            }
        }
        $scope.data.reloadContractor = () => {
            contractorSearch.get((response) => {
                $scope.data.contractors = response.data.contractors
            }, $scope.data.find.name, false)
        }
        $scope.data.reloadStock = () => {
            stockSearch.get((response) => {
                $scope.data.stocks = response.data.stocks
            }, $scope.data.find.name)
        }
        $scope.data.selectContractor = (contractor) => {
            $scope.data.contractorId = contractor.id
            $scope.data.contractorShow = false
            $scope.data.contractor = contractor
        }
        $scope.data.showSelectContractor = () => {
            $scope.data.contractorShow = true
            $scope.data.reloadContractor()
        }
        $scope.data.contractorHide = () => {
            $scope.data.contractorShow = false
        }
        $scope.data.productHide = () => {
            $scope.data.productShow = false
        }
        $scope.data.stockHide = () => {
            $scope.data.stockShow = false
        }
        $scope.data.showSelectProduct = () => {
            $scope.data.reloadProduct()
        }
        $scope.data.showSelectStock = () => {
            $scope.data.stockShow = true
            $scope.data.reloadStock()
        }
        //$scope.data.reloadContractor()
        //$scope.data.reloadProduct()
        //$scope.data.reloadStock()
        $scope.data.selectStock = (stock) => {
            $scope.data.stockShow = false
            stock.count = 1
            stock.vat = stock.vat + ''
            stock.productId = stock.id
            delete stock.id
            $scope.data.document.products.push(stock)
            $scope.data.callcNet(stock)
            $scope.data.refreshResume()
        }
        $scope.remove = (rows, row) => {
            row.deleted = true
        }
        $scope.data.callcNet = (product) => {
            net = (product.net + '').replace ? parseFloat((product.net + '').replace(',', '.')) : 0
            count = (product.count + '').replace ? parseFloat((product.count + '').replace(',', '.')) : 0
            product.sumNet = (net * count).toFixed(2)

            vat = product.vat
            product.sumVat = ((net * count) * (product.vat / 100)).toFixed(2)

            product.sumGross = ((net * count) + ((net * count) * (product.vat / 100))).toFixed(2)
            $scope.data.refreshResume()
        }
        $scope.data.callcSumNet = (product) => {
            sumNet = (product.sumNet + '').replace ? parseFloat((product.sumNet + '').replace(',', '.')) : 0
            count = (product.count + '').replace ? parseFloat((product.count + '').replace(',', '.')) : 0
            product.net = (sumNet / count).toFixed(2)

            vat = product.vat
            product.sumVat = (sumNet * (product.vat / 100)).toFixed(2)

            product.sumGross = (sumNet + (sumNet * (product.vat / 100))).toFixed(2)
            $scope.data.refreshResume()
            //$scope.data.callcNet()
        }
        $scope.data.callcSumGross = (product) => {
            sumGross = (product.sumGross + '').replace ? parseFloat((product.sumGross + '').replace(',', '.')) : 0
            count = (product.count + '').replace ? parseFloat((product.count + '').replace(',', '.')) : 0
            vat = product.vat
            product.sumVat = ((sumGross / (100 + parseFloat(product.vat))) * parseFloat(product.vat)).toFixed(2)
            product.sumNet = (sumGross - product.sumVat).toFixed(2)
            product.net = (product.sumNet / count).toFixed(2)
            $scope.data.refreshResume()
            //$scope.data.callcNet()
        }
        $scope.data.refreshResume = () => {
            sumNet = 0
            sumGross = 0
            angular.forEach($scope.data.document.products, (product) => {
                sumNet += parseFloat(product.sumNet)
                sumGross += parseFloat(product.net) * parseFloat(product.count) * (100 + parseFloat(product.vat)) / 100
            })
            $scope.data.document.sumNet = sumNet.toFixed(2)
            $scope.data.document.sumGross = sumGross.toFixed(2)
            $scope.data.document.sumVat = (sumGross - sumNet).toFixed(2)
            $scope.data.refreshSummary()
        }
        $scope.data.refreshSummary = () => {
            sumGross = 0
            angular.forEach($scope.data.document.products, (product) => {
                sumGross += parseFloat(product.net) * parseFloat(product.count) * (100 + parseFloat(product.vat)) / 100
            })
        }
        if(!$routeParams.id) {
            $http.get(apiBase + '/document/number/ord').then((response) => {
                $scope.data.document.name = response.data.name
                $scope.data.document.documentNumberId = response.data.documentNumberId
            })
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.sku) {
                $rootScope.filters.push({
                    name: 'number',
                    kind: '%',
                    value: $scope.filters.number,
                })
            }
            $scope.orders = [];
            pagination.page = 1;
            loadPage()
        }
    })

    /*.factory('showError', function (errorDialog) {
        return {
            show: function (message) {
                errorDialog.show({
                    title: '',
                    templateUrl: '/Public/Template/Pl-pl/ErrorDialog.html',
                    data: {
                        message: message
                    }
                })
            }
        }
    })*/

    .factory('stockSearch', function ($http) {
        return {
            get: function (callback, search) {
                $http.post(apiBase + '/stock/search', {search: search}).then(callback);
            }
        }
    })

    .factory('contractorSearch', function ($http) {
        return {
            get: function (callback, search, supplier = false) {
                $http.post(apiBase + '/contractor/search', {search: search, supplier: supplier}).then(callback);
            }
        }
    })

    .factory('productSearch', function ($http) {
        return {
            get: function (callback, search) {
                $http.post(apiBase + '/catalog/product/search', {search: search}).then(callback);
            }
        }
    })

    .controller('contractorEditController', function (showError, $routeParams, $scope, $http, $location, contractor) {
        $scope.data = {
            id: $routeParams.id,
            document: {},
            validation: {
                code: true,
                name: true,
            },
            contractor: {
                name: null,
                code: null,
            }
        }
        $scope.filters = {
            name: '',
        }
        loadPage = () => {
            if ($routeParams.id) {
                contractor.get(function (response) {
                    $scope.data.contractor = response.data;
                }, $routeParams.id);
            }
        }
        $scope.data.send = function () {
            $scope.data.validation.name = $scope.data.contractor.name ? false : true
            $scope.data.validation.code = $scope.data.contractor.code ? false : true
            validate = true
            angular.forEach($scope.data.validation, (el) => {
                if (el) {
                    validate = false
                }
            })
            if (!validate) {
                if ($scope.data.validation.code) {
                    showError.show($scope, 'Wprowadź kod kontrahenta')
                } else if ($scope.data.validation.name) {
                    showError.show($scope, 'Wprowadź nazwę kontrahenta')
                }
                return
            }
            var data = $scope.data.contractor;
            if ($routeParams.id) {
                $http.put(apiBase + '/contractor/' + $routeParams.id, data).then(function (response) {
                    if (response.data.success) {
                        //$location.path('/katalog/produkty');
                    }
                });
                //$scope.messages = response.data.errors
            } else {
                $http.post(apiBase + '/contractor', data).then(function (response) {
                    if (response.data.id) {
                        $scope.data.id = response.data.id;
                        $location.path('/kontrahent/' + response.data.id, false);
                    }
                    //$scope.messages = response.data.errors
                });
            }
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.name) {
                $rootScope.filters.push({
                    name: 'name',
                    kind: '%',
                    value: $scope.filters.name,
                })
            }
            $scope.contractors = [];
            pagination.page = 1;
            loadPage()
        }
        loadPage()
    })

    .controller('productionEditController', function (showError, $routeParams, $scope, $http, $location, production) {
        $scope.data = {
            id: $routeParams.id,
            validation: {
                name: true,
            },
            production: {
                name: null,
            }
        }
        $scope.filters = {
            name: '',
        }
        loadPage = () => {
            if ($scope.data.id) {
                production.get(function (response) {
                    $scope.data.production = response.data;
                }, $scope.data.id);
            }
        }
        $scope.data.send = function () {
            $scope.data.validation.name = $scope.data.production.name ? false : true
            validate = true
            angular.forEach($scope.data.validation, (el) => {
                if (el) {
                    validate = false
                }
            })
            if (!validate) {
                if ($scope.data.validation.name) {
                    showError.show($scope, 'Wprowadź nazwę produkcji')
                }
                return
            }
            var data = $scope.data.production;
            if ($scope.data.id) {
                $http.put(apiBase + '/production/' + $scope.data.id, data).then(function (response) {
                    if (response.data.success) {
                        //$location.path('/katalog/produkty');
                    }
                });
                //$scope.messages = response.data.errors
            } else {
                $http.post(apiBase + '/production', data).then(function (response) {
                    if (response.data.id) {
                        $scope.data.id = response.data.id;
                        $location.path('/produkcja/' + response.data.id, false);
                    }
                    //$scope.messages = response.data.errors
                });
            }
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.name) {
                $rootScope.filters.push({
                    name: 'name',
                    kind: '%',
                    value: $scope.filters.name,
                })
            }
            $scope.productions = [];
            pagination.page = 1;
            loadPage()
        }
        loadPage()
    })

    .controller('channelEditController', function (showError, $routeParams, $scope, $http, $location, channel) {
        $scope.data = {
            id: $routeParams.id,
            validation: {
                name: true,
            },
            channel: {
                name: null,
            }
        }
        $scope.filters = {
            name: '',
            amount: '',
        }
        const loadPage = () => {
            if ($scope.data.id) {
                channel.get(function (response) {
                    $scope.data.channel = response.data;
                }, $scope.data.id);
            }
        }
        $scope.data.send = function () {
            $scope.data.validation.name = $scope.data.channel.name ? false : true
            validate = true
            angular.forEach($scope.data.validation, (el) => {
                if (el) {
                    validate = false
                }
            })
            if (!validate) {
                if ($scope.data.validation.name) {
                    showError.show($scope, 'Wprowadź nazwę kanału')
                }
                return
            }
            var data = $scope.data.channel;
            if ($scope.data.id) {
                $http.put(apiBase + '/channel/' + $scope.data.id, data).then(function (response) {
                    if (response.data.success) {
                        //$location.path('/katalog/produkty');
                    }
                });
                //$scope.messages = response.data.errors
            } else {
                $http.post(apiBase + '/channel', data).then(function (response) {
                    if (response.data.id) {
                        $scope.data.id = response.data.id;
                        $location.path('/kanal-sprzedazy/' + response.data.id, false);
                    }
                    //$scope.messages = response.data.errors
                });
            }
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.name) {
                $rootScope.filters.push({
                    name: 'name',
                    kind: '%',
                    value: $scope.filters.name,
                })
            }
            $scope.cashs = [];
            pagination.page = 1;
            loadPage()
        }
        loadPage()
    })

    .controller('cashEditController', function (showError, $routeParams, $scope, $http, $location, cash) {
        $scope.data = {
            id: $routeParams.id,
            validation: {
                number: true,
                amount: true,
            },
            cash: {
                number: null,
                amount: null,
                kind: 'kp',
            }
        }
        $scope.filters = {
            name: '',
            amount: '',
        }
        const loadPage = () => {
            if ($scope.data.id) {
                cash.get(function (response) {
                    $scope.data.cash = response.data;
                }, $scope.data.id);
            }else{
                $http.get(apiBase+'/document/number/'+$scope.data.cash.kind).then((response)=>{
                    $scope.data.cash.documentNumberId = response.data.documentNumberId
                    $scope.data.cash.number = response.data.name
                })
            }
        }
        $scope.data.send = function () {
            $scope.data.validation.number = $scope.data.cash.number ? false : true
            $scope.data.validation.amount = $scope.data.cash.amount ? false : true
            validate = true
            angular.forEach($scope.data.validation, (el) => {
                if (el) {
                    validate = false
                }
            })
            if (!validate) {
                if ($scope.data.validation.number) {
                    showError.show($scope, 'Wprowadź numer dokumentu')
                }else if ($scope.data.validation.amount) {
                    showError.show($scope, 'Wprowadź kwotę')
                }
                return
            }
            var data = $scope.data.cash;
            if ($scope.data.id) {
                $http.put(apiBase + '/cash/' + $scope.data.id, data).then(function (response) {
                    if (response.data.success) {
                        //$location.path('/katalog/produkty');
                    }
                });
                //$scope.messages = response.data.errors
            } else {
                $http.post(apiBase + '/cash', data).then(function (response) {
                    if (response.data.id) {
                        $scope.data.id = response.data.id;
                        $location.path('/kasa/' + response.data.id, false);
                    }
                    //$scope.messages = response.data.errors
                });
            }
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.number) {
                $rootScope.filters.push({
                    name: 'name',
                    kind: '%',
                    value: $scope.filters.number,
                })
            }
            if ($scope.filters.amount) {
                $rootScope.filters.push({
                    name: 'amount',
                    kind: '=',
                    value: $scope.filters.amount,
                })
            }
            $scope.cashs = [];
            pagination.page = 1;
            loadPage()
        }
        $scope.$watch('data.cash.kind', ()=>{
            $http.get(apiBase+'/document/number/'+$scope.data.cash.kind).then((response)=>{
                $scope.data.cash.documentNumberId = response.data.documentNumberId
                $scope.data.cash.number = response.data.name
            })
        })
        loadPage()
    })

    .controller('uploadController', function ($scope, $element, Upload, productImages, deleteDialog, $http) {
        $scope.files = [];
        $scope.deleteImage = function (rows, row) {
            deleteDialog.show({
                title: 'Usunięcie zdjęcia',
                templateUrl: '/Public/Template/Pl-pl/DeleteDialog.html',
                apiUrl: '/catalog/product/' + $scope.$parent.data.id + '/image/',
                data: {
                    rows: rows,
                    row: row,
                }
            });
        }
        if ($scope.$parent.data.id) {
            productImages.get(function (response) {
                $scope.files = response.data.files;
            }, $scope.$parent.data.id);
        }
        $scope.drop = function (e) {
            $scope.submit();
        }
        $scope.select = function (event) {
            $scope.submit();
            event.preventDefault();
        }
        $scope.submit = function () {
            $scope.upload($scope.file);
        };
        $scope.abort = function (event) {
            if ($scope.xhr) {
                $scope.xhr.abort();
            }
            $scope.uploading = false;
            event ? event.preventDefault() : {};
        };
        $scope.upload = function (file) {
            var files = [];
            angular.forEach(file, function (value, key) {
                files.push(value);
                var fileReader = new FileReader();
                fileReader.readAsDataURL(value);
                fileReader.onload = function (e) {
                    var dataUrl = e.target.result;
                    var name = value.name;
                    var type = value.type;
                    var base64Data = dataUrl.substr(dataUrl.indexOf('base64,') + 'base64,'.length);
                    $scope.uploading = true;
                    Upload.upload({
                        url: apiBase + '/files/upload',
                        data: {
                            file: [{
                                name: name,
                                type: type,
                                data: base64Data,
                            }]
                        }
                    }).success(function (resp) {
                        angular.forEach(resp.file, function (value, key) {
                            $http.put(apiBase + '/catalog/product/' + $scope.$parent.data.id + '/image/' + value.id).then(function () {
                                if (!$scope.files) {
                                    $scope.files = [];
                                }
                                $scope.files.push(value);
                            });
                        });
                        $scope.abort();
                    }).error(function (resp) {
                    }).progress(function (evt) {
                        $scope.progress = (parseFloat(Math.round(100 * (evt.loaded / evt.total)))).toFixed(2) + '%';
                    }).xhr(function (e, xhr) {
                        $scope.xhr = xhr;
                    });
                    ;
                }
            });
        };
    })

    .controller('uploadAttachmentController', function (productAttachments, $scope, $element, Upload, productImages, deleteDialog, $http) {
        $scope.files = [];
        $scope.setSelectOptions = function (deleteUrl, titleField, itemsName) {
            $scope.deleteUrl = deleteUrl;
            $scope.titleField = titleField;
            $scope.itemsName = itemsName;
        }
        $scope.deleteAttachment = function (rows, row) {
            deleteDialog.show($scope, {
                title: 'Usunięcie załącznika',
                templateUrl: '/Public/Template/Pl-pl/DeleteDialog.html',
                data: {
                    id: row.id,
                    row: row,
                    apiUrl: $scope.deleteUrl + $scope.$parent.data.product.id + '/attachment',
                },
                accept: (data, node) => {
                    data.row.remove()
                }
            });
        }
        if ($scope.$parent.data.id) {
            productAttachments.get(function (response) {
                $scope.files = response.data.files;
            }, $scope.$parent.data.id);
        }
        $scope.drop = function (e) {
            $scope.submit();
        }
        $scope.select = function (event) {
            $scope.submit();
            event.preventDefault();
        }
        $scope.submit = function () {
            $scope.upload($scope.file);
        };
        $scope.abort = function (event) {
            if ($scope.xhr) {
                $scope.xhr.abort();
            }
            $scope.uploading = false;
            event ? event.preventDefault() : {};
        };
        $scope.upload = function (file) {
            var files = [];
            angular.forEach(file, function (value, key) {
                files.push(value);
                var fileReader = new FileReader();
                fileReader.readAsDataURL(value);
                fileReader.onload = function (e) {
                    var dataUrl = e.target.result;
                    var name = value.name;
                    var type = value.type;
                    var base64Data = dataUrl.substr(dataUrl.indexOf('base64,') + 'base64,'.length);
                    $scope.uploading = true;
                    Upload.upload({
                        url: apiBase + '/files/upload',
                        data: {
                            file: [{
                                name: name,
                                type: type,
                                data: base64Data,
                            }]
                        }
                    }).success(function (resp) {
                        angular.forEach(resp.file, function (value, key) {
                            $http.put(apiBase + '/catalog/product/' + $scope.$parent.data.id + '/attachment/' + value.id).then(function () {
                                if (!$scope.files) {
                                    $scope.files = [];
                                }
                                $scope.files.push(value);
                            });
                        });
                        $scope.abort();
                    }).error(function (resp) {
                    }).progress(function (evt) {
                        $scope.progress = (parseFloat(Math.round(100 * (evt.loaded / evt.total)))).toFixed(2) + '%';
                    }).xhr(function (e, xhr) {
                        $scope.xhr = xhr;
                    });
                    ;
                }
            });
        };
    })

    .factory('productImages', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/catalog/product/' + id + '/image').then(callback);
            }
        }
    })

    .factory('productAttachments', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/catalog/product/' + id + '/attachment').then(callback);
            }
        }
    })

    .directive('upload', function ($rootScope) {
        return {
            restrict: 'E',
            scope: {
                data: '=data'
            },
            templateUrl: '/Public/Template/Pl-pl/UploadImage.html',
            controller: 'uploadController',
        }
    })

    .directive('uploadAttachment', function ($rootScope) {
        return {
            restrict: 'E',
            scope: {
                data: '=data'
            },
            templateUrl: '/Public/Template/Pl-pl/UploadAttachment.html',
            controller: 'uploadAttachmentController',
        }
    })

    .factory('catalogProduct', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/catalog/product/' + id).then(callback);
            }
        }
    })

    .factory('document', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/document/' + id).then(callback);
            }
        }
    })

    .factory('order', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/orders/' + id).then(callback);
            }
        }
    })

    .factory('contractor', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/contractor/' + id).then(callback);
            }
        }
    })

    .factory('production', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/production/' + id).then(callback);
            }
        }
    })

    .factory('cash', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/cash/' + id).then(callback);
            }
        }
    })

    .factory('channel', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/channel/' + id).then(callback);
            }
        }
    })

    .factory('catalogCategories', function ($http) {
        return {
            get: function (callback) {
                $http.get(apiBase + '/catalog/category').then(callback);
            }
        }
    })

    .controller('catalogProductsController', function ($rootScope, $scope, $http, catalogProducts, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        var filters = [];
        var filtersNames = [];
        $scope.products = [];
        $rootScope.filters = filters;
        $scope.filters = {
            sku: '',
            name: '',
        }
        var getData = function (pagination, data) {
            if (data && (data.length > 0)) {
                return data;
            }
            return pagination
        }
        var loadPage = function () {
            catalogProducts.get(function (response) {
                angular.forEach(response.data.products, function (value, key) {
                    if(value.net) {
                        value.net = value.net.toFixed(2)
                        $scope.products.push(value);
                    }
                });
                pagination = getData(pagination, response.data.pagination);
                filters = getData(filters, response.data.filters);
                filtersNames = getData(filtersNames, response.data.filtersNames);
                $rootScope.filters = filters;
                $rootScope.filtersNames = filtersNames;
            }, pagination, $rootScope.filters);
        }
        $scope.reload = (row) => {
            angular.forEach($scope.products, function (value, key) {
                if (value.id == row.id) {
                    value.sku = row.sku
                    value.name = row.name
                }
            });
        }
        $scope.deleteRow = function (rows, row) {
            deleteDialog.show($scope, {
                title: 'Usunięcie produktu',
                data: {
                    rows: rows,
                    row: row,
                    id: row.id,
                    apiUrl: '/catalog/product'
                },
            });
        }
        $scope.fluentLoad = function () {
            pagination.page++;
            loadPage();
        }
        loadPage();
        $rootScope.filterRefreshCallback = function () {
            $scope.products = [];
            pagination.page = 1;
            loadPage();
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.sku) {
                $rootScope.filters.push({
                    name: 'sku',
                    kind: '%',
                    value: $scope.filters.sku,
                })
            }
            if ($scope.filters.name) {
                $rootScope.filters.push({
                    name: 'name',
                    kind: '%',
                    value: $scope.filters.name,
                })
            }
            $scope.products = [];
            pagination.page = 1;
            loadPage()
        }
        $scope.synchronizeProducts = ()=>{
            $http.put(apiBase+'/integration/presta/synchronize').then(()=>{})
        }
        $scope.allegroSend = (product)=>{
            $http.get(apiBase+'/integration/allegro/send/'+product.id).then(()=>{})
        }
    })

    .controller('documentsController', function ($rootScope, $scope, $http, documents, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        var filters = [];
        var filtersNames = [];
        $scope.documents = [];
        $rootScope.filters = filters;
        $scope.filters = {
            name: '',
            date: '',
        }
        var getData = function (pagination, data) {
            if (data && (data.length > 0)) {
                return data;
            }
            return pagination
        }
        var loadPage = function () {
            documents.get(function (response) {
                angular.forEach(response.data.documents, function (value, key) {
                    $scope.documents.push(value);
                });
                pagination = getData(pagination, response.data.pagination);
                filters = getData(filters, response.data.filters);
                filtersNames = getData(filtersNames, response.data.filtersNames);
                $rootScope.filters = filters;
                $rootScope.filtersNames = filtersNames;
            }, pagination, $rootScope.filters);
        }
        $scope.deleteRow = function (rows, row) {
            deleteDialog.show($scope, {
                title: 'Usunięcie dokumentu',
                templateUrl: '/Public/Template/Pl-pl/DeleteDialog.html',
                data: {
                    rows: rows,
                    row: row,
                    id: row.id,
                    apiUrl: '/document',
                }
            });
        }
        $scope.fluentLoad = function () {
            pagination.page++;
            loadPage();
        }
        loadPage();
        $rootScope.filterRefreshCallback = function () {
            $scope.documents = [];
            pagination.page = 1;
            loadPage();
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.name) {
                $rootScope.filters.push({
                    name: 'name',
                    kind: '%',
                    value: $scope.filters.name,
                })
            }
            if ($scope.filters.date) {
                $rootScope.filters.push({
                    name: 'date',
                    kind: '%',
                    value: $scope.filters.date,
                })
            }
            $scope.documents = [];
            pagination.page = 1;
            loadPage()
        }
        $scope.deleteUrl = '/document'
    })

    .factory('documents', function ($http, $httpParamSerializerJQLike) {
        return {
            get: function (callback, pagination, filters) {
                var pagin = $httpParamSerializerJQLike({pagination: pagination});
                var filt = $httpParamSerializerJQLike({filters: filters});
                if (pagin) {
                    pagin += '&';
                }
                $http.get(apiBase + '/document?' + pagin + filt).then(callback);
            }
        }
    })

    .controller('productionsController', function ($rootScope, $scope, $http, productions, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        var filters = [];
        var filtersNames = [];
        $scope.productions = [];
        $rootScope.filters = filters;
        $scope.filters = {
            name: '',
            date: '',
        }
        var getData = function (pagination, data) {
            if (data && (data.length > 0)) {
                return data;
            }
            return pagination
        }
        var loadPage = function () {
            productions.get(function (response) {
                angular.forEach(response.data.productions, function (value, key) {
                    $scope.productions.push(value);
                });
                pagination = getData(pagination, response.data.pagination);
                filters = getData(filters, response.data.filters);
                filtersNames = getData(filtersNames, response.data.filtersNames);
                $rootScope.filters = filters;
                $rootScope.filtersNames = filtersNames;
            }, pagination, $rootScope.filters);
        }
        $scope.deleteRow = function (rows, row) {
            deleteDialog.show($scope, {
                title: 'Usunięcie produkcji',
                templateUrl: '/Public/Template/Pl-pl/DeleteDialog.html',
                data: {
                    rows: rows,
                    row: row,
                    id: row.id,
                    apiUrl: '/production',
                }
            });
        }
        $scope.fluentLoad = function () {
            pagination.page++;
            loadPage();
        }
        loadPage();
        $rootScope.filterRefreshCallback = function () {
            $scope.productions = [];
            pagination.page = 1;
            loadPage();
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.name) {
                $rootScope.filters.push({
                    name: 'name',
                    kind: '%',
                    value: $scope.filters.name,
                })
            }
            $scope.productions = [];
            pagination.page = 1;
            loadPage()
        }
        $scope.deleteUrl = '/production'
    })

    .controller('cashsController', function ($rootScope, $scope, $http, cashs, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        var filters = [];
        var filtersNames = [];
        $scope.cashs = [];
        $rootScope.filters = filters;
        $scope.filters = {
            number: '',
            date: '',
            amount: '',
        }
        var getData = function (pagination, data) {
            if (data && (data.length > 0)) {
                return data;
            }
            return pagination
        }
        const loadPage = function () {
            cashs.get(function (response) {
                angular.forEach(response.data.cashs, function (value, key) {
                    $scope.cashs.push(value);
                });
                $scope.sum = response.data.sum
                pagination = getData(pagination, response.data.pagination)
                filters = getData(filters, response.data.filters)
                filtersNames = getData(filtersNames, response.data.filtersNames)
                $rootScope.filters = filters
                $rootScope.filtersNames = filtersNames
            }, pagination, $rootScope.filters)
        }
        $scope.deleteRow = function (rows, row) {
            deleteDialog.show($scope, {
                title: 'Usunięcie dokumentu kasowego',
                templateUrl: '/Public/Template/Pl-pl/DeleteDialog.html',
                data: {
                    rows: rows,
                    row: row,
                    id: row.id,
                    apiUrl: '/cash',
                }
            });
        }
        $scope.fluentLoad = function () {
            pagination.page++;
            loadPage();
        }
        loadPage();
        $rootScope.filterRefreshCallback = function () {
            $scope.productions = [];
            pagination.page = 1;
            loadPage();
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.name) {
                $rootScope.filters.push({
                    name: 'number',
                    kind: '%',
                    value: $scope.filters.number,
                })
            }
            if ($scope.filters.date) {
                $rootScope.filters.push({
                    name: 'date',
                    kind: '%',
                    value: $scope.filters.date,
                })
            }
            if ($scope.filters.amount) {
                $rootScope.filters.push({
                    name: 'amount',
                    kind: '=',
                    value: $scope.filters.amount,
                })
            }
            $scope.cashs = [];
            pagination.page = 1;
            loadPage()
        }
        $scope.deleteUrl = '/cash'
        $scope.closeCash = ()=>{
            $http.put(apiBase+'/cash/close').then((response)=>{})
        }
    })

    .factory('productions', function ($http, $httpParamSerializerJQLike) {
        return {
            get: function (callback, pagination, filters) {
                var pagin = $httpParamSerializerJQLike({pagination: pagination});
                var filt = $httpParamSerializerJQLike({filters: filters});
                if (pagin) {
                    pagin += '&';
                }
                $http.get(apiBase + '/production?' + pagin + filt).then(callback);
            }
        }
    })

    .controller('channelsController', function ($rootScope, $scope, $http, channels, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        var filters = [];
        var filtersNames = [];
        $scope.channels = [];
        $rootScope.filters = filters;
        $scope.filters = {
            name: '',
        }
        var getData = function (pagination, data) {
            if (data && (data.length > 0)) {
                return data;
            }
            return pagination
        }
        const loadPage = function () {
            channels.get(function (response) {
                angular.forEach(response.data.channels, function (value, key) {
                    $scope.channels.push(value);
                });
                pagination = getData(pagination, response.data.pagination)
                filters = getData(filters, response.data.filters)
                filtersNames = getData(filtersNames, response.data.filtersNames)
                $rootScope.filters = filters
                $rootScope.filtersNames = filtersNames
            }, pagination, $rootScope.filters)
        }
        $scope.deleteRow = function (rows, row) {
            deleteDialog.show($scope, {
                title: 'Usunięcie kanału sprzedaży',
                templateUrl: '/Public/Template/Pl-pl/DeleteDialog.html',
                data: {
                    rows: rows,
                    row: row,
                    id: row.id,
                    apiUrl: '/cash',
                }
            });
        }
        $scope.fluentLoad = function () {
            pagination.page++;
            loadPage();
        }
        loadPage();
        $rootScope.filterRefreshCallback = function () {
            $scope.channels = [];
            pagination.page = 1;
            loadPage();
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.name) {
                $rootScope.filters.push({
                    name: 'number',
                    kind: '%',
                    value: $scope.filters.name,
                })
            }
            $scope.channels = [];
            pagination.page = 1;
            loadPage()
        }
        $scope.deleteUrl = '/channel'
    })

    .factory('channels', function ($http, $httpParamSerializerJQLike) {
        return {
            get: function (callback, pagination, filters) {
                var pagin = $httpParamSerializerJQLike({pagination: pagination});
                var filt = $httpParamSerializerJQLike({filters: filters});
                if (pagin) {
                    pagin += '&';
                }
                $http.get(apiBase + '/channel?' + pagin + filt).then(callback);
            }
        }
    })

    .factory('cashs', function ($http, $httpParamSerializerJQLike) {
        return {
            get: function (callback, pagination, filters) {
                var pagin = $httpParamSerializerJQLike({pagination: pagination});
                var filt = $httpParamSerializerJQLike({filters: filters});
                if (pagin) {
                    pagin += '&';
                }
                $http.get(apiBase + '/cash?' + pagin + filt).then(callback);
            }
        }
    })

    .factory('userProfil', function ($http) {
        return {
            get: function (callback) {
                $http.get(apiBase + '/user/profile').then(callback);
            }
        }
    })

    .controller('contractorsController', function ($rootScope, $scope, $http, contractors, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        var filters = [];
        var filtersNames = [];
        $scope.contractors = [];
        $rootScope.filters = filters;
        $scope.filters = {
            name: '',
            code: '',
        }
        var getData = function (pagination, data) {
            if (data && (data.length > 0)) {
                return data;
            }
            return pagination
        }
        var loadPage = function () {
            contractors.get(function (response) {
                angular.forEach(response.data.contractors, function (value, key) {
                    $scope.contractors.push(value);
                });
                pagination = getData(pagination, response.data.pagination);
                filters = getData(filters, response.data.filters);
                filtersNames = getData(filtersNames, response.data.filtersNames);
                $rootScope.filters = filters;
                $rootScope.filtersNames = filtersNames;
            }, pagination, $rootScope.filters);
        }
        $scope.reload = (row) => {
            angular.forEach($scope.contractors, function (value, key) {
                if (value.id == row.id) {
                    value.code = row.code
                    value.name = row.name
                }
            });
        }
        $scope.deleteRow = function (rows, row) {
            deleteDialog.show($scope, {
                title: 'Usunięcie kontrahenta',
                data: {
                    rows: rows,
                    row: row,
                    id: row.id,
                    apiUrl: '/contractor'
                },
            });
        }
        $scope.fluentLoad = function () {
            pagination.page++;
            loadPage();
        }
        loadPage();
        $rootScope.filterRefreshCallback = function () {
            $scope.contractors = [];
            pagination.page = 1;
            loadPage();
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.name) {
                $rootScope.filters.push({
                    name: 'name',
                    kind: '%',
                    value: $scope.filters.name,
                })
            }
            if ($scope.filters.code) {
                $rootScope.filters.push({
                    name: 'code',
                    kind: '%',
                    value: $scope.filters.code,
                })
            }
            $scope.contractors = [];
            pagination.page = 1;
            loadPage()
        }
    })

    .factory('contractors', function ($http, $httpParamSerializerJQLike) {
        return {
            get: function (callback, pagination, filters) {
                var pagin = $httpParamSerializerJQLike({pagination: pagination});
                var filt = $httpParamSerializerJQLike({filters: filters});
                if (pagin) {
                    pagin += '&';
                }
                $http.get(apiBase + '/contractor?' + pagin + filt).then(callback);
            }
        }
    })

    .controller('debtorsController', function ($rootScope, $scope, $http, debtors, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        var filters = [];
        var filtersNames = [];
        $scope.debtors = [];
        $rootScope.filters = filters;
        $scope.filters = {
            name: '',
            code: '',
            debt: '',
        }
        var getData = function (pagination, data) {
            if (data && (data.length > 0)) {
                return data;
            }
            return pagination
        }
        var loadPage = function () {
            debtors.get(function (response) {
                angular.forEach(response.data.debtors, function (value, key) {
                    $scope.debtors.push(value);
                });
                pagination = getData(pagination, response.data.pagination);
                filters = getData(filters, response.data.filters);
                filtersNames = getData(filtersNames, response.data.filtersNames);
                $rootScope.filters = filters;
                $rootScope.filtersNames = filtersNames;
            }, pagination, $rootScope.filters);
        }
        $scope.reload = (row) => {
            angular.forEach($scope.debtors, function (value, key) {
                if (value.id == row.id) {
                    value.code = row.code
                    value.name = row.name
                }
            });
        }
        $scope.deleteRow = function (rows, row) {
            deleteDialog.show($scope, {
                title: 'Usunięcie dłużnika',
                data: {
                    rows: rows,
                    row: row,
                    id: row.id,
                    apiUrl: '/debtor'
                },
            });
        }
        $scope.fluentLoad = function () {
            pagination.page++;
            loadPage();
        }
        loadPage();
        $rootScope.filterRefreshCallback = function () {
            $scope.debts = [];
            pagination.page = 1;
            loadPage();
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.name) {
                $rootScope.filters.push({
                    name: 'name',
                    kind: '%',
                    value: $scope.filters.name,
                })
            }
            if ($scope.filters.code) {
                $rootScope.filters.push({
                    name: 'code',
                    kind: '%',
                    value: $scope.filters.code,
                })
            }
            if ($scope.filters.debt) {
                $rootScope.filters.push({
                    name: 'debt',
                    kind: '=',
                    value: $scope.filters.debt,
                })
            }
            $scope.debtors = [];
            pagination.page = 1;
            loadPage()
        }
    })

    .factory('debtors', function ($http, $httpParamSerializerJQLike) {
        return {
            get: function (callback, pagination, filters) {
                var pagin = $httpParamSerializerJQLike({pagination: pagination});
                var filt = $httpParamSerializerJQLike({filters: filters});
                if (pagin) {
                    pagin += '&';
                }
                $http.get(apiBase + '/debtor?' + pagin + filt).then(callback);
            }
        }
    })

    .controller('ordersController', function ($rootScope, $scope, $http, orders, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        var filters = [];
        var filtersNames = [];
        $scope.orders = [];
        $rootScope.filters = filters;
        $scope.filters = {
            number: '',
            date: '',
        }
        var getData = function (pagination, data) {
            if (data && (data.length > 0)) {
                return data;
            }
            return pagination
        }
        var loadPage = function () {
            orders.get(function (response) {
                //$scope.orders = []
                angular.forEach(response.data.orders, function (order, orderKey) {
                    angular.forEach(order.products, function (product, productKey) {
                        product.net = product.net.toFixed(2)
                        product.sumNet = product.sumNet.toFixed(2)
                        product.sumGross = product.sumGross.toFixed(2)
                        order.products[productKey] = product
                    });
                    $scope.orders.push(order);
                });
                pagination = getData(pagination, response.data.pagination);
                filters = getData(filters, response.data.filters);
                filtersNames = getData(filtersNames, response.data.filtersNames);
                $rootScope.filters = filters;
                $rootScope.filtersNames = filtersNames;
            }, pagination, $rootScope.filters);
        }
        $scope.fluentLoad = function () {
            pagination.page++;
            loadPage();
        }
        loadPage();
        $rootScope.filterRefreshCallback = function () {
            $scope.orders = [];
            pagination.page = 1;
            loadPage();
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.number) {
                $rootScope.filters.push({
                    name: 'number',
                    kind: '%',
                    value: $scope.filters.number,
                })
            }
            if ($scope.filters.date) {
                $rootScope.filters.push({
                    name: 'date',
                    kind: '%',
                    value: $scope.filters.date,
                })
            }
            $scope.orders = [];
            pagination.page = 1;
            loadPage()
        }
        $scope.orderPrices = (order) => {
            $http.get(apiBase + '/orders/check/price').then((response) => {
                let prices = response.data.prices
                angular.forEach(prices, (value, key) => {
                    value.priceText = parseFloat(value.price).toFixed(2)
                    value.name = value.number
                })
                order.prices = prices
            })
        }
        $scope.orderAdd = (order) => {
            $http.post(apiBase + '/orders/add/' + order.id, {courier: $scope.lastSelected.service}).then((response) => {
                order.id = response.data.id
                order.courier = response.data.courier
                order.courierNumber = response.data.courierNumber
                order.courierPrice = response.data.courierPrice
            })
        }
        $scope.lastSelected = null
        $scope.selectPrice = (prices, price) => {
            angular.forEach(prices, (p) => {
                p.selected = false
            })
            price.selected = true
            $scope.lastSelected = price
        }
        $scope.addInvoice = (order) => {
            $http.put(apiBase + '/document/add/invoice/' + order.id).then((response) => {
                if (response.data.number) {
                    order.documentId = response.data.id
                    order.invoiceNumber = response.data.number
                }
            })
        }
        $scope.callOrders = () => {
            $http.get(apiBase + '/orders/call').then((response) => {
                angular.forEach(response.data.orders, (order) => {
                    angular.forEach($scope.orders, (o) => {
                        if (o.id == order.id) {
                            o.pickup = order.pickup
                        }
                    })
                })
            })
        }
        $scope.prestaDownload = () => {
            $http.get(apiBase + '/integration/presta/refresh').then((response) => {
            })
        }
    })

    .factory('orders', function ($http, $httpParamSerializerJQLike) {
        return {
            get: function (callback, pagination, filters) {
                var pagin = $httpParamSerializerJQLike({pagination: pagination});
                var filt = $httpParamSerializerJQLike({filters: filters});
                if (pagin) {
                    pagin += '&';
                }
                $http.get(apiBase + '/orders?' + pagin + filt).then(callback);
            }
        }
    })

    .controller('stocksController', function ($rootScope, $scope, $http, stocks, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        var filters = [];
        var filtersNames = [];
        $scope.stocks = [];
        $rootScope.filters = filters;
        $scope.filters = {
            name: '',
            sku: '',
            count: '',
        }
        var getData = function (pagination, data) {
            if (data && (data.length > 0)) {
                return data;
            }
            return pagination
        }
        var loadPage = function () {
            stocks.get(function (response) {
                angular.forEach(response.data.stocks, function (value, key) {
                    $scope.stocks.push(value);
                });
                pagination = getData(pagination, response.data.pagination);
                filters = getData(filters, response.data.filters);
                filtersNames = getData(filtersNames, response.data.filtersNames);
                $rootScope.filters = filters;
                $rootScope.filtersNames = filtersNames;
            }, pagination, $rootScope.filters);
        }
        $scope.fluentLoad = function () {
            pagination.page++;
            loadPage();
        }
        loadPage();
        $rootScope.filterRefreshCallback = function () {
            $scope.stocks = [];
            pagination.page = 1;
            loadPage();
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.name) {
                $rootScope.filters.push({
                    name: 'name',
                    kind: '%',
                    value: $scope.filters.name,
                })
            }
            if ($scope.filters.sku) {
                $rootScope.filters.push({
                    name: 'sku',
                    kind: '%',
                    value: $scope.filters.sku,
                })
            }
            if ($scope.filters.count) {
                $rootScope.filters.push({
                    name: 'count',
                    kind: '%',
                    value: $scope.filters.count,
                })
            }
            $scope.stocks = [];
            pagination.page = 1;
            loadPage()
        }
    })

    .factory('stocks', function ($http, $httpParamSerializerJQLike) {
        return {
            get: function (callback, pagination, filters) {
                var pagin = $httpParamSerializerJQLike({pagination: pagination});
                var filt = $httpParamSerializerJQLike({filters: filters});
                if (pagin) {
                    pagin += '&';
                }
                $http.get(apiBase + '/stock?' + pagin + filt).then(callback);
            }
        }
    })

    .factory('catalogProducts', function ($http, $httpParamSerializerJQLike) {
        return {
            get: function (callback, pagination, filters) {
                var pagin = $httpParamSerializerJQLike({pagination: pagination});
                var filt = $httpParamSerializerJQLike({filters: filters});
                if (pagin) {
                    pagin += '&';
                }
                $http.get(apiBase + '/catalog/product?' + pagin + filt).then(callback);
            }
        }
    })

    .controller('registerController', function ($scope, $location, $http) {
        $scope.send = function () {
            $http.post(apiBase + '/user/register', {
                mail: $scope.mail,
                password: $scope.password,
            }).then(function (response) {
                if (response.data.code) {
                    $location.path('/zarejestrowano');
                }
            });
        }
    })

    .controller('afterRegisterController', function ($scope, $location, $http) {
    })

    .controller('accountActivateController', function ($scope, $location, $http, activateAccount, $routeParams) {
        activateAccount.get(function (response) {
            console.log(response);
        }, $routeParams.code, $routeParams.confirmationCode);
    })

    .factory('activateAccount', function ($http) {
        return {
            get: function (callback, code, confirmationCode) {
                $http.get(apiBase + '/user/register/' + code + '/confirm/' + confirmationCode).then(callback);
            }
        }
    })

    .controller('loginController', function ($scope, $location, $http, $rootScope) {
        $scope.send = function () {
            $http.post(apiBase + '/user/login', {
                mail: $scope.mail,
                password: $scope.password,
            }).then(function (response) {
                if (response.data.success) {
                    $rootScope.user.logged = true;
                    $location.path('/panel');
                } else {
                    $scope.messages = response.data.messages
                }
            });
        }
    })


;