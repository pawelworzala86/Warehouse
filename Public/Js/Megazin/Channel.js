angular.module('Megazin')

    .controller('channelEditController', function (showError, $routeParams, $scope, $http, $location, channel) {
        $scope.data = {
            id: $routeParams.id,
            validation: {
                name: true,
                host: true,
                key: true,
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
            $scope.data.validation.host = $scope.data.channel.host ? false : true
            $scope.data.validation.key = $scope.data.channel.key ? false : true
            validate = true
            angular.forEach($scope.data.validation, (el) => {
                if (el) {
                    validate = false
                }
            })
            if (!validate) {
                if ($scope.data.validation.name) {
                    showError.show($scope, 'Wprowadź nazwę kanału')
                }else if ($scope.data.validation.host) {
                    showError.show($scope, 'Wprowadź adres URL sklepu')
                }else if ($scope.data.validation.key) {
                    showError.show($scope, 'Wprowadź klucz API')
                }
                return
            }
            var data = $scope.data.channel;
            if ($scope.data.id) {
                $http.put(apiBase + '/channel/' + $scope.data.id, data).then(function (response) {
                    if (response.data.success) {
                        $location.path('/kanaly-sprzedazy');
                    }
                });
                //$scope.messages = response.data.errors
            } else {
                $http.post(apiBase + '/channel', data).then(function (response) {
                    if (response.data.id) {
                        $scope.data.id = response.data.id;
                        //$location.path('/kanal-sprzedazy/' + response.data.id, false);
                        $location.path('/kanaly-sprzedazy');
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

    .controller('channelsController', function ($rootScope, $scope, $http, channels, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        $scope.channels = [];
        $rootScope.filters = [];
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
                    apiUrl: '/channel',
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

    .factory('channel', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/channel/' + id).then(callback);
            }
        }
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