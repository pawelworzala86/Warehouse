angular.module('Megazin')

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
                        $location.path('/kontrahenci');
                    }
                });
                //$scope.messages = response.data.errors
            } else {
                $http.post(apiBase + '/contractor', data).then(function (response) {
                    if (response.data.id) {
                        $scope.data.id = response.data.id;
                        //$location.path('/kontrahent/' + response.data.id, false);
                        $location.path('/kontrahenci');
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
            $scope.contractors = [];
            pagination.page = 1;
            loadPage()
        }*/
        loadPage()
    })

    .controller('contractorsController', function ($rootScope, $scope, $http, contractors, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        $scope.contractors = [];
        $rootScope.filters = [];
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

    .factory('contractorSearch', function ($http) {
        return {
            get: function (callback, search, supplier = false) {
                $http.post(apiBase + '/contractor/search', {search: search, supplier: supplier}).then(callback);
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