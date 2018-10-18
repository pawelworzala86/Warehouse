angular.module('Megazin')

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
                        $location.path('/produkcje');
                    }
                });
                //$scope.messages = response.data.errors
            } else {
                $http.post(apiBase + '/production', data).then(function (response) {
                    if (response.data.id) {
                        $scope.data.id = response.data.id;
                        //$location.path('/produkcja/' + response.data.id, false);
                        $location.path('/produkcje');
                    }
                    //$scope.messages = response.data.errors
                });
            }
        }
        /*$scope.filter = () => {
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
        }*/
        loadPage()
    })

    .controller('productionsController', function ($rootScope, $scope, $http, productions, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        $scope.productions = [];
        $rootScope.filters = [];
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

    .factory('production', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/production/' + id).then(callback);
            }
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