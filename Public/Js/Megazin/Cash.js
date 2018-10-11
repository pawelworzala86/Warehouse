angular.module('Megazin')

    .controller('cashEditController', function (showError, $routeParams, $scope, $http, $location, cash) {
        $scope.data = {
            id: $routeParams.id,
            validation: {
                number: true,
                amount: true,
            },
            cash: {
                number: null,
                amount: null,
                kind: 'kp',
            }
        }
        $scope.filters = {
            name: '',
            amount: '',
        }
        const loadPage = () => {
            if ($scope.data.id) {
                cash.get(function (response) {
                    $scope.data.cash = response.data;
                }, $scope.data.id);
            }else{
                $http.get(apiBase+'/document/number/'+$scope.data.cash.kind).then((response)=>{
                    $scope.data.cash.documentNumberId = response.data.documentNumberId
                    $scope.data.cash.number = response.data.name
                })
            }
        }
        $scope.data.send = function () {
            $scope.data.validation.number = $scope.data.cash.number ? false : true
            $scope.data.validation.amount = $scope.data.cash.amount ? false : true
            validate = true
            angular.forEach($scope.data.validation, (el) => {
                if (el) {
                    validate = false
                }
            })
            if (!validate) {
                if ($scope.data.validation.number) {
                    showError.show($scope, 'Wprowadź numer dokumentu')
                }else if ($scope.data.validation.amount) {
                    showError.show($scope, 'Wprowadź kwotę')
                }
                return
            }
            var data = $scope.data.cash;
            if ($scope.data.id) {
                $http.put(apiBase + '/cash/' + $scope.data.id, data).then(function (response) {
                    if (response.data.success) {
                        $location.path('/kasa');
                    }
                });
                //$scope.messages = response.data.errors
            } else {
                $http.post(apiBase + '/cash', data).then(function (response) {
                    if (response.data.id) {
                        $scope.data.id = response.data.id;
                        //$location.path('/kasa/' + response.data.id, false);
                        $location.path('/kasa');
                    }
                    //$scope.messages = response.data.errors
                });
            }
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.number) {
                $rootScope.filters.push({
                    name: 'name',
                    kind: '%',
                    value: $scope.filters.number,
                })
            }
            if ($scope.filters.amount) {
                $rootScope.filters.push({
                    name: 'amount',
                    kind: '=',
                    value: $scope.filters.amount,
                })
            }
            $scope.cashs = [];
            pagination.page = 1;
            loadPage()
        }
        $scope.$watch('data.cash.kind', ()=>{
            $http.get(apiBase+'/document/number/'+$scope.data.cash.kind).then((response)=>{
                $scope.data.cash.documentNumberId = response.data.documentNumberId
                $scope.data.cash.number = response.data.name
            })
        })
        loadPage()
    })

    .controller('cashsController', function ($rootScope, $scope, $http, cashs, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        var filters = [];
        var filtersNames = [];
        $scope.cashs = [];
        $rootScope.filters = filters;
        $scope.filters = {
            number: '',
            date: '',
            amount: '',
        }
        var getData = function (pagination, data) {
            if (data && (data.length > 0)) {
                return data;
            }
            return pagination
        }
        const loadPage = function () {
            cashs.get(function (response) {
                angular.forEach(response.data.cashs, function (value, key) {
                    $scope.cashs.push(value);
                });
                $scope.sum = response.data.sum
                pagination = getData(pagination, response.data.pagination)
                filters = getData(filters, response.data.filters)
                filtersNames = getData(filtersNames, response.data.filtersNames)
                $rootScope.filters = filters
                $rootScope.filtersNames = filtersNames
            }, pagination, $rootScope.filters)
        }
        $scope.deleteRow = function (rows, row) {
            deleteDialog.show($scope, {
                title: 'Usunięcie dokumentu kasowego',
                templateUrl: '/Public/Template/Pl-pl/DeleteDialog.html',
                data: {
                    rows: rows,
                    row: row,
                    id: row.id,
                    apiUrl: '/cash',
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
                    name: 'number',
                    kind: '%',
                    value: $scope.filters.number,
                })
            }
            if ($scope.filters.date) {
                $rootScope.filters.push({
                    name: 'date',
                    kind: '%',
                    value: $scope.filters.date,
                })
            }
            if ($scope.filters.amount) {
                $rootScope.filters.push({
                    name: 'amount',
                    kind: '=',
                    value: $scope.filters.amount,
                })
            }
            $scope.cashs = [];
            pagination.page = 1;
            loadPage()
        }
        $scope.deleteUrl = '/cash'
        $scope.closeCash = ()=>{
            $http.put(apiBase+'/cash/close').then((response)=>{})
        }
    })

    .factory('cash', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/cash/' + id).then(callback);
            }
        }
    })

    .factory('cashs', function ($http, $httpParamSerializerJQLike) {
        return {
            get: function (callback, pagination, filters) {
                var pagin = $httpParamSerializerJQLike({pagination: pagination});
                var filt = $httpParamSerializerJQLike({filters: filters});
                if (pagin) {
                    pagin += '&';
                }
                $http.get(apiBase + '/cash?' + pagin + filt).then(callback);
            }
        }
    })