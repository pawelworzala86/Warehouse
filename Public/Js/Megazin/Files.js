angular.module('Megazin')

    .controller('systemFilesController', function (modalDialog, $rootScope, $scope, getFiles, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        $scope.files = [];
        $rootScope.filters = [];
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