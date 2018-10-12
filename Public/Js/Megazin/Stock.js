angular.module('Megazin')

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
        ////
        $scope.labels = ["January", "February", "March", "April", "May", "June", "July"]
        $scope.series = ['Series A'/*, 'Series B'*/]
        $scope.data = [
            [65, 59, 80, 81, 56, 55, 40],
            //[28, 48, 40, 19, 86, 27, 90]
        ]
        $scope.onClick = function (points, evt) {
            //console.log(points, evt)
        }
        $scope.datasetOverride = [{yAxisID: 'y-axis-1'}/*, {yAxisID: 'y-axis-2'}*/]
        $scope.options = {
            scales: {
                yAxes: [
                    {
                        id: 'y-axis-1',
                        type: 'linear',
                        display: true,
                        position: 'left'
                    }/*,
                    {
                        id: 'y-axis-2',
                        type: 'linear',
                        display: true,
                        position: 'right'
                    }*/
                ]
            }
        }
        $scope.colors = ['rgba(255,255,255,0.2)'];////
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