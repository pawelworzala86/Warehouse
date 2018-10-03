var base = '';
var apiBase = '/api';
var templateBase = '/Public/Template/Pl-pl/';

angular.module('Megazin', ['ngRoute', 'btford.modal', 'ui.tree', 'ngFileUpload'])

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

    .controller('systemFilesController', function ($rootScope, $scope, getFiles, deleteDialog) {
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
            deleteDialog.show({
                title: 'Usunięcie produktu',
                templateUrl: '/Public/Template/Pl-pl/DeleteDialog.html',
                apiUrl: '/system/files/',
                data: {
                    rows: rows,
                    row: row,
                }
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

    .controller('filtersController', function ($rootScope, $scope, modal) {
        $scope.add = function () {
            modal({
                templateUrl: function () {
                    return '/Public/Template/Pl-pl/FilterDialog.html'
                },
                title: function () {
                    return 'Dodawanie nowego filtra'
                },
                cancel: function () {
                },
                accept: function (callback, scope) {
                    var filter = {
                        name: scope.name,
                        kind: scope.kind,
                        value: scope.value,
                    }
                    $rootScope.filters.push(filter);
                    callback();
                },
                data: function () {
                    return {};
                }
            }).activate();
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
        $scope.del = function (rows, row) {
            var index = findInSelect(rows, row);
            if (index > -1) {
                rows.splice(index, 1);
            }
            index = findInSelect($rootScope.filters, row);
            if (index > -1) {
                $rootScope.filters.splice(index, 1);
            }
        }
        $scope.search = function () {
            $rootScope.showFilter = false;
            $rootScope.filterRefreshCallback();
        }
    })

    .factory('modal', function (btfModal) {
        var modal = null;
        return function (functions) {
            if (functions) {
                var templateUrl = functions.templateUrl();
                modal = btfModal({
                    controller: 'modalController',
                    controllerAs: 'modal',
                    templateUrl: templateUrl,
                });
                modal.functions = functions;
            }
            return modal;
        };
    })

    .controller('modalController', function ($scope, modal) {
        this.title = modal().functions.title();
        if (modal().functions.data) {
            this.data = modal().functions.data();
        }
        this.cancel = function () {
            var m = modal();
            m.functions.cancel();
            m.deactivate();
        };
        this.accept = function () {
            var m = modal();
            m.functions.accept(function () {
                m.deactivate();
            }, this);
        };
    })

    .controller('landingController', function ($scope) {
    })

    .controller('selectTableController', function ($scope, deleteDialog, $http) {
        $scope.selects = [];
        $scope.setSelectOptions = function (deleteUrl, titleField, itemsName) {
            $scope.deleteUrl = deleteUrl;
            $scope.titleField = titleField;
            $scope.itemsName = itemsName;
        }
        var removeFromSelect = function (index, row) {
            $scope.selects.splice(index, 1);
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
            $scope.selects.push(data);
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
            var index = findInSelect($scope.selects, row);
            if (index < 0) {
                addToSelect(row);
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
            var index = findInSelect($scope.selects, row);
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
        $scope.massDelete = function (rows, row) {
            deleteDialog.show({
                title: 'Usunięcie wielu pozycji',
                templateUrl: '/Public/Template/Pl-pl/DeleteMassDialog.html',
                apiUrl: $scope.deleteUrl,
                data: {
                    selects: $scope.selects,
                    rows: rows,
                    row: row,
                },
                scope: $scope,
            });
        }
        $scope.loadDetail = (url, products, product) => {
            product.detail = true
            $http.get(apiBase + url + '/' + product.id).then(function (response) {
                product.detail = response.data
            });
        }
    })

    .controller('catalogCategoriesController', function ($scope, $http, catalogCategories, modal, deleteDialog) {
        $scope.categories = [];
        catalogCategories.get(function (response) {
            $scope.categories = response.data.categories ? response.data.categories : [];
        })
        $scope.add = function (item, items) {
            modal({
                templateUrl: function () {
                    return '/Public/Template/Pl-pl/Catalog/AddCategoryDialog.html'
                },
                title: function () {
                    return 'Dodawanie nowej kategorii do katalogu'
                },
                cancel: function () {
                },
                accept: function (callback, scope) {
                    $http.post(apiBase + '/catalog/category', scope.data).then(function (response) {
                        $scope.categories.push({
                            id: response.data.id,
                            name: scope.data.name,
                            parentId: scope.data.parentId,
                            categories: [],
                        });
                        callback();
                    });
                }
            }).activate();
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
            modal({
                templateUrl: function () {
                    return '/Public/Template/Pl-pl/Catalog/AddCategoryDialog.html'
                },
                title: function () {
                    return 'Edycja kategorii do katalogu'
                },
                cancel: function () {
                },
                accept: function (callback, scope) {
                    $http.put(apiBase + '/catalog/category/' + element.id, {
                        id: scope.data.id,
                        name: scope.data.name,
                        parentId: scope.data.parentId,
                    }).then(function (response) {
                        element.name = scope.data.name;
                        callback();
                    });
                },
                data: function () {
                    return {
                        id: element.id,
                        name: element.name,
                        parentId: element.parentId,
                    }
                }
            }).activate();
        }
    })

    .factory('deleteDialog', function ($http, modal) {
        return {
            show: function (options) {
                modal({
                    templateUrl: function () {
                        return options.templateUrl
                    },
                    title: function () {
                        return options.title
                    },
                    cancel: function () {
                    },
                    accept: function (callback, scope) {
                        if (options.data.selects && (options.data.selects.length > 0)) {
                            var ids = [];
                            angular.forEach(options.data.selects, function (value, key) {
                                ids.push(value.id);
                            });
                            $http.post(apiBase + options.apiUrl + '/mass/delete', {ids: ids}).then(function (response) {
                                if (response.data.success) {
                                    options.scope.selects = [];
                                    options.scope.clear(options.scope[options.scope.itemsName]);
                                    callback();
                                }
                            });
                        } else {
                            $http.delete(apiBase + options.apiUrl + options.data.row.id).then(function (response) {
                                var i = 0;
                                var index = null;
                                angular.forEach(options.data.rows, function (value, key) {
                                    if (value.id == options.data.row.id) {
                                        index = i;
                                    }
                                    i++;
                                });
                                if (index !== null) {
                                    options.data.rows.splice(index, 1);
                                }
                                callback();
                            });
                        }
                    },
                    data: function () {
                        return options.data;
                    }
                }).activate();
            }
        }
    })

    .factory('errorDialog', function ($http, modal) {
        return {
            show: function (options) {
                modal({
                    templateUrl: function () {
                        return options.templateUrl
                    },
                    title: function () {
                        return options.title
                    },
                    cancel: function () {
                    },
                    accept: function (callback, scope) {
                        /*if (options.data.selects && (options.data.selects.length > 0)) {
                            var ids = [];
                            angular.forEach(options.data.selects, function (value, key) {
                                ids.push(value.id);
                            });
                            $http.post(apiBase + options.apiUrl + '/mass/delete', {ids: ids}).then(function (response) {
                                if (response.data.success) {
                                    options.scope.selects = [];
                                    options.scope.clear(options.scope[options.scope.itemsName]);
                                    callback();
                                }
                            });
                        } else {
                            $http.delete(apiBase + options.apiUrl + options.data.row.id).then(function (response) {
                                var i = 0;
                                var index = null;
                                angular.forEach(options.data.rows, function (value, key) {
                                    if (value.id == options.data.row.id) {
                                        index = i;
                                    }
                                    i++;
                                });
                                if (index !== null) {
                                    options.data.rows.splice(index, 1);
                                }
                                callback();
                            });
                        }*/
                    },
                    data: function () {
                        return options.data;
                    }
                }).activate();
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
                    showError.show('Wprowadź kod SKU')
                } else if ($scope.data.validation.name) {
                    showError.show('Wprowadź nazwę towaru')
                }else if ($scope.data.validation.sellNet) {
                    showError.show('Wprowadź cenę sprzedaży netto')
                }else if ($scope.data.validation.sellGross) {
                    showError.show('Wprowadź cenę sprzedaży brutto')
                }else if ($scope.data.validation.vat) {
                    showError.show('Wybierz stawkę VAT')
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
            {id: 5, name: 'Dostawcy', disable: true}
        ];
        $scope.imagesUploadOptions = {}
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

    .controller('documentEditController', function (showError, $routeParams, $scope, $http, $location, document, contractorSearch, productSearch, stockSearch, errorDialog) {
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
            }, $routeParams.id);
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
            } else if (!$scope.data.contractorId) {
                validate = false
            }
            if (!validate) {
                if ($scope.data.validation.name) {
                    showError.show('Wprowadź numer dokumentu')
                } else if ($scope.data.validation.date) {
                    showError.show('Wprowadź datę dokumentu')
                } else if ($scope.data.validation.payDate) {
                    showError.show('Wprowadź datę zapłaty')
                } else if ($scope.data.validation.issuePlace) {
                    showError.show('Wprowadź miejsce wystawienia')
                } else if ($scope.data.validation.deliveryDate) {
                    showError.show('Wprowadź datę otrzymania')
                } else if (!$scope.data.document.products.length > 0) {
                    showError.show('Wybierz jakieś produkty')
                } else if (!$scope.data.contractorId) {
                    showError.show('Wybierz kontrahenta')
                } else if ($scope.data.validation.payment) {
                    if ((data.document.type === 'fvp') || (data.document.type === 'fvs')) {
                        showError.show('Wybierz metodę płatności')
                    }
                }
                return
            }
            var data = $scope.data.document
            data.contractorId = $scope.data.contractorId
            if ($routeParams.id) {
                $http.put(apiBase + '/document/' + $routeParams.id, data).then(function (response) {
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
            }, $scope.data.find.name)
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
        }
        $scope.data.showSelectStock = () => {
            $scope.data.stockShow = true
        }
        $scope.data.reloadContractor()
        $scope.data.reloadProduct()
        $scope.data.reloadStock()
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
                ]
            }
            //alert(loadedType)
            $scope.data.document.type = loadedType
        })
        $scope.$watch('data.document.type', () => {
            if (!$routeParams.id) {
                $http.get(apiBase + '/document/number/' + $scope.data.document.type).then((response) => {
                    $scope.data.document.name = response.data.name
                })
            }
        })
    })

    .factory('showError', function (errorDialog) {
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
    })

    .factory('stockSearch', function ($http) {
        return {
            get: function (callback, search) {
                $http.post(apiBase + '/stock/search', {search: search}).then(callback);
            }
        }
    })

    .factory('contractorSearch', function ($http) {
        return {
            get: function (callback, search) {
                $http.post(apiBase + '/contractor/search', {search: search}).then(callback);
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
                    showError.show('Wprowadź kod kontrahenta')
                } else if ($scope.data.validation.name) {
                    showError.show('Wprowadź nazwę kontrahenta')
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

    .factory('productImages', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/catalog/product/' + id + '/image').then(callback);
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

    .factory('contractor', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/contractor/' + id).then(callback);
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
                    $scope.products.push(value);
                });
                pagination = getData(pagination, response.data.pagination);
                filters = getData(filters, response.data.filters);
                filtersNames = getData(filtersNames, response.data.filtersNames);
                $rootScope.filters = filters;
                $rootScope.filtersNames = filtersNames;
            }, pagination, $rootScope.filters);
        }
        $scope.deleteRow = function (rows, row) {
            deleteDialog.show({
                title: 'Usunięcie produktu',
                templateUrl: '/Public/Template/Pl-pl/DeleteDialog.html',
                apiUrl: '/catalog/product/',
                data: {
                    rows: rows,
                    row: row,
                }
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
            deleteDialog.show({
                title: 'Usunięcie dokumentu',
                templateUrl: '/Public/Template/Pl-pl/DeleteDialog.html',
                apiUrl: '/document/',
                data: {
                    rows: rows,
                    row: row,
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
        $scope.deleteRow = function (rows, row) {
            deleteDialog.show({
                title: 'Usunięcie dokumentu',
                templateUrl: '/Public/Template/Pl-pl/DeleteDialog.html',
                apiUrl: '/contractor/',
                data: {
                    rows: rows,
                    row: row,
                }
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