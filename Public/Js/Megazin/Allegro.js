angular.module('Megazin')

    .controller('allegroShipmentsController', function ($rootScope, $scope, $http, allegroShipments, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        $scope.shipments = [];
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
            allegroShipments.get(function (response) {
                angular.forEach(response.data.shipments, function (value, key) {
                    $scope.shipments.push(value);
                });
            });
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
        $scope.prepareShipment = ()=>{
            $http.get(apiBase+'/integration/allegro/shipment/prepare')
        }
    })

    .factory('allegroShipments', function ($http, $httpParamSerializerJQLike) {
        return {
            get: function (callback) {
                $http.get(apiBase + '/integration/allegro/shipment').then(callback);
            }
        }
    })