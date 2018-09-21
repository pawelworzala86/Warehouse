var base = '';
var templateBase = '/Public/Template/Pl-pl';

angular.module('Admin', ['ngRoute', 'btford.modal', 'ui.tree'])

    .config(function ($routeProvider, $locationProvider, $compileProvider, $httpProvider) {
        //console.log('setup router');
        angular.forEach(routes, function (value, key) {
            $routeProvider.when(base + value.url, {
                templateUrl: value.template,
                controller: value.controller,
            });
        });

        $locationProvider.html5Mode(true);
        $compileProvider.debugInfoEnabled(true);
        delete $httpProvider.defaults.headers.common['X-Requested-With'];
        $httpProvider.defaults.useXDomain = true;
        $httpProvider.defaults.withCredentials = true;
    })
    .run(function ($rootScope, $http, $location, $timeout, $window) {
        $rootScope.baseUrl = base;
        $rootScope.user_id = false;
    })
    .factory('deleteModal', function (btfModal) {
        var modal = null;
        return function (functions) {
            var templateUrl = '';
            if (functions)
                templateUrl = functions.templateUrl();
            if (!modal)
                modal = btfModal({
                    controller: 'deleteModalController',
                    controllerAs: 'modal',
                    templateUrl: templateUrl,
                });
            if (functions)
                modal.functions = functions;
            return modal;
        };
    })

    .controller('deleteModalController', function ($scope, deleteModal) {
        this.cancel = function () {
            var modal = deleteModal();
            modal.functions.cancel();
            modal.deactivate();
        };
        this.accept = function () {
            var modal = deleteModal();
            modal.functions.accept(function () {
                modal.deactivate();
            }, $scope);
        };
    })

    .controller('mainController', function ($scope, $location, loader, $http, deleteModal) {
        var path = $location.path();
        var url = '/api' + path;
        if (apiRoutes[path]) {
            var url = apiRoutes[path];
        }
        loader.get(function (data) {
            $scope.data = angular.fromJson(data.data);
        }, url);
        $scope.filter = function () {
            loader.get(function (data) {
                $scope.data = angular.fromJson(data.data);
            }, url, {filter: $scope.data.filter});
        };
        $scope.send = function () {
            $scope.data.action = 'edit';
            $http.post(url, $scope.data).then(function (data) {
                data = angular.fromJson(data.data);
                $location.path(data.redirect);
            });
        }
        $scope.del = function (item, items) {
            deleteModal({
                templateUrl: function () {
                    return '/Public/Template/Pl-pl/DeleteDialog.html'
                },
                cancel: function () {
                },
                accept: function (callback, scope) {
                    $scope.data.action = 'delete';
                    $http.post(url, item).then(function (data) {
                        var i = 0;
                        var index = 0;
                        angular.forEach(items, function (value, key) {
                            if (value.id == item.id) {
                                index = i;
                            }
                            i++;
                        });
                        items.splice(index, 1);
                        callback();
                    });
                }
            }).activate();
        }
    })

    .factory('loader', function ($http) {
        return {
            get: function (callback, url, data=null) {
                $http.post(url, data).then(callback);
            }
        }
    })

    .controller('werhousesController', function ($scope, $location, $http) {
        $scope.switch = function (werhouse) {
            $http.post('/api/werhouse/' + werhouse.sys_unique_id + '/switch', {}).then(function (value) {
                $location.path('/magazyn');
            });
        }
    })

    .factory('selectProductModal', function (btfModal) {
        var modal = null;
        return function (functions) {
            var templateUrl = '';
            if (functions)
                templateUrl = functions.templateUrl();
            if (!modal)
                modal = btfModal({
                    controller: 'selectProductController',
                    controllerAs: 'modal',
                    templateUrl: templateUrl,
                });
            if (functions)
                modal.functions = functions;
            return modal;
        };
    })

    .controller('selectProductController', function ($scope, selectProductModal, loadProducts) {
        /*this.cancel = function () {
            var modal = selectContractorModal();
            modal.functions.cancel();
            modal.deactivate();
        };
        this.accept = function () {
            var modal = selectContractorModal();
            modal.functions.accept(function () {
                modal.deactivate();
            }, $scope);
        };*/
        this.select = function (product) {
            var modal = selectProductModal();
            $scope.product = product;
            modal.functions.select(function () {
                modal.deactivate();
            }, $scope);
        };
        var modal = this;
        loadProducts.get(function (data) {
            data = angular.fromJson(data.data);
            modal.products = data;
        });
    })

    .factory('loadProducts', function ($http) {
        return {
            get: function (callback) {
                $http.post('/api/products', {
                    search: {sku: '', name: ''},
                    countAdd: 'dec',
                    intermediate: 'add',
                }).then(callback);
            }
        }
    })

    .factory('selectContractorModal', function (btfModal) {
        var modal = null;
        return function (functions) {
            var templateUrl = '';
            if (functions)
                templateUrl = functions.templateUrl();
            if (!modal)
                modal = btfModal({
                    controller: 'selectContractorController',
                    controllerAs: 'modal',
                    templateUrl: templateUrl,
                });
            if (functions)
                modal.functions = functions;
            return modal;
        };
    })

    .controller('selectContractorController', function ($scope, selectContractorModal, loadContractors) {
        /*this.cancel = function () {
            var modal = selectContractorModal();
            modal.functions.cancel();
            modal.deactivate();
        };
        this.accept = function () {
            var modal = selectContractorModal();
            modal.functions.accept(function () {
                modal.deactivate();
            }, $scope);
        };*/
        this.select = function (contractor) {
            var modal = selectContractorModal();
            $scope.contractor_id = contractor.id;
            modal.functions.select(function () {
                modal.deactivate();
            }, $scope);
        };
        var modal = this;
        loadContractors.get(function (data) {
            data = angular.fromJson(data.data);
            modal.contractors = data;
        });
    })

    .factory('loadContractors', function ($http) {
        return {
            get: function (callback) {
                $http.post('/api/contractors', {
                    search: '',
                    provider: 'add',
                }).then(callback);
            }
        }
    })

    .controller('werhouseAddController', function ($scope, $location, $http, selectContractorModal, loader, selectProductModal) {
        var url = '/api' + $location.path();
        loader.get(function (data) {
            $scope.data = angular.fromJson(data.data);
        }, url);
        $scope.send = function () {
            $scope.data.action = 'add';
            $http.post(url, $scope.data).then(function (data) {
                data = angular.fromJson(data.data);
                $location.path(data.redirect);
            });
        }
        $scope.selectContractor = function () {
            selectContractorModal({
                templateUrl: function () {
                    return '/Public/Template/Pl-pl/Werhouse/SelectContractorDialog.html'
                },
                select: function (callback, scope) {
                    $scope.data.contractor_id = scope.contractor_id;
                    //console.log($scope.data.contractor_id);
                    callback();
                },
                /*cancel: function () {
                },
                accept: function (callback, scope) {
                    $scope.data.action = 'delete';
                    $http.post(url, item).then(function (data) {
                        var i = 0;
                        var index = 0;
                        angular.forEach(items, function (value, key) {
                            if (value.id == item.id) {
                                index = i;
                            }
                            i++;
                        });
                        items.splice(index, 1);
                        callback();
                    });
                }*/
            }).activate();
        }
        $scope.selectProduct = function () {
            selectProductModal({
                templateUrl: function () {
                    return '/Public/Template/Pl-pl/Werhouse/SelectProductDialog.html'
                },
                select: function (callback, scope) {
                    if (!$scope.data.products) {
                        $scope.data.products = [];
                    }
                    $scope.data.products.push(scope.product);
                    //console.log($scope.data.contractor_id);
                    callback();
                },
                /*cancel: function () {
                },
                accept: function (callback, scope) {
                    $scope.data.action = 'delete';
                    $http.post(url, item).then(function (data) {
                        var i = 0;
                        var index = 0;
                        angular.forEach(items, function (value, key) {
                            if (value.id == item.id) {
                                index = i;
                            }
                            i++;
                        });
                        items.splice(index, 1);
                        callback();
                    });
                }*/
            }).activate();
        }
    })
;