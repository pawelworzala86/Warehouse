angular.module('Megazin')

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