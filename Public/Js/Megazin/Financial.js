angular.module('Megazin')

    .controller('financialEditController', function (showError, $routeParams, $scope, $http, $location, financial, documentSearch) {
        $scope.data = {
            id: $routeParams.id,
            document: {},
            validation: {
                date: true,
                amount: true,
            },
            financial: {
                date: (date = new Date()).getFullYear() + '-' + ((month = (date.getMonth() + 1)) < 10 ? ('0' + month) : month) + '-' + date.getDate(),
                amount: null,
            },
            find: {
                name: '',
            }
        }
        loadPage = () => {
            if ($routeParams.id) {
                financial.get(function (response) {
                    $scope.data.financial = response.data;
                }, $routeParams.id);
            }
        }
        $scope.data.send = function () {
            $scope.data.validation.date = $scope.data.financial.date ? false : true
            $scope.data.validation.amount = $scope.data.financial.amount ? false : true
            validate = true
            angular.forEach($scope.data.validation, (el) => {
                if (el) {
                    validate = false
                }
            })
            if (!validate) {
                if ($scope.data.validation.date) {
                    showError.show($scope, 'Wprowadź datę operacji')
                } else if ($scope.data.validation.amount) {
                    showError.show($scope, 'Wprowadź kwotę operacji')
                }
                return
            }
            var data = $scope.data.financial;
            if ($routeParams.id) {
                $http.put(apiBase + '/financial/' + $routeParams.id, data).then(function (response) {
                    if (response.data.success) {
                        $location.path('/finanse');
                    }
                });
                //$scope.messages = response.data.errors
            } else {
                $http.post(apiBase + '/financial', data).then(function (response) {
                    if (response.data.id) {
                        $scope.data.id = response.data.id;
                        //$location.path('/kontrahent/' + response.data.id, false);
                        $location.path('/finanse');
                    }
                    //$scope.messages = response.data.errors
                });
            }
        }
        loadPage()
        $scope.data.reloadDocument = () => {
            documentSearch.get((response) => {
                $scope.data.documents = response.data.documents
            }, $scope.data.find.name)
        }
        $scope.data.showSelectDocument = () => {
            $scope.data.documentShow = true
            $scope.data.reloadDocument()
        }
        $scope.data.documentHide = () => {
            $scope.data.documentShow = false
        }
        $scope.data.selectDocument = (document) => {
            $scope.data.documentShow = false
            $scope.data.financial.documentId = document.id
            $scope.data.financial.documentNumber = document.name
        }
    })

    .factory('documentSearch', function ($http) {
        return {
            get: function (callback, search) {
                $http.post(apiBase + '/document/search', {search: search}).then(callback);
            }
        }
    })

    .controller('financialsController', function ($rootScope, $scope, $http, financials, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        var filters = [];
        var filtersNames = [];
        $scope.financials = [];
        $rootScope.filters = filters;
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
            financials.get(function (response) {
                angular.forEach(response.data.financials, function (value, key) {
                    $scope.financials.push(value);
                });
                pagination = getData(pagination, response.data.pagination);
                filters = getData(filters, response.data.filters);
                filtersNames = getData(filtersNames, response.data.filtersNames);
                $rootScope.filters = filters;
                $rootScope.filtersNames = filtersNames;
            }, pagination, $rootScope.filters);
        }
        $scope.reload = (row) => {
            angular.forEach($scope.financials, function (value, key) {
                if (value.id == row.id) {
                    value.date = row.date
                    value.amount = row.amount
                }
            });
        }
        $scope.deleteRow = function (rows, row) {
            deleteDialog.show($scope, {
                title: 'Usunięcie operacji finansowej',
                data: {
                    rows: rows,
                    row: row,
                    id: row.id,
                    apiUrl: '/financial'
                },
            });
        }
        $scope.fluentLoad = function () {
            pagination.page++;
            loadPage();
        }
        loadPage();
        $rootScope.filterRefreshCallback = function () {
            $scope.financials = [];
            pagination.page = 1;
            loadPage();
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.name) {
                $rootScope.filters.push({
                    name: 'date',
                    kind: '%',
                    value: $scope.filters.date,
                })
            }
            if ($scope.filters.code) {
                $rootScope.filters.push({
                    name: 'amount',
                    kind: '=',
                    value: $scope.filters.amount,
                })
            }
            $scope.contractors = [];
            pagination.page = 1;
            loadPage()
        }
    })

    .factory('financial', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/financial/' + id).then(callback);
            }
        }
    })

    .factory('financials', function ($http, $httpParamSerializerJQLike) {
        return {
            get: function (callback, pagination, filters) {
                var pagin = $httpParamSerializerJQLike({pagination: pagination});
                var filt = $httpParamSerializerJQLike({filters: filters});
                if (pagin) {
                    pagin += '&';
                }
                $http.get(apiBase + '/financial?' + pagin + filt).then(callback);
            }
        }
    })