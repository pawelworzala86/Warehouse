angular.module('Megazin')

    .controller('stocksController', function ($rootScope, $scope, $http, stocks, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        $scope.stocks = [];
        $rootScope.filters = [];
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

    .factory('stockSearch', function ($http) {
        return {
            get: function (callback, search) {
                $http.post(apiBase + '/stock/search', {search: search}).then(callback);
            }
        }
    })