angular.module('Megazin')

    .controller('documentEditController', function (showError, $routeParams, $scope, $http, $location, document, contractorSearch, productSearch, stockSearch) {
        $scope.data = {
            id: $routeParams.id,
            document: {
                products: [],
                stocks: [],
                date: (date = new Date()).getFullYear() + '-' + ((month = (date.getMonth() + 1)) < 10 ? ('0' + month) : month) + '-' + date.getDate(),
                deliveryDate: (date = new Date()).getFullYear() + '-' + ((month = (date.getMonth() + 1)) < 10 ? ('0' + month) : month) + '-' + date.getDate(),
                payDate: (date = (new Date())) ? (date.setDate(date.getDate() + 14) ? (date.getFullYear() + '-' + ((month = (date.getMonth() + 1)) < 10 ? ('0' + month) : month) + '-' + date.getDate()) : '') : '',
                payment: 'money',
            },
            validation: {
                name: true,
                date: true,
                payDate: true,
                issuePlace: true,
                deliveryDate: true,
                payment: false,
            },
            contractorShow: false,
            find: {
                name: '',
                date: '',
                payDate: '',
            },
            products: [],
            stocks: [],
            productionId: $routeParams.productionId,
            cashDocument: true,
        }
        $scope.data.vatRates = [
            {
                name: '23%',
                value: '23'
            },
            {
                name: '8%',
                value: '8'
            },
            {
                name: '5%',
                value: '5'
            },
            {
                name: '0%',
                value: '0'
            },
            {
                name: 'zw',
                value: '0'
            }
        ]
        loadedType = '';
        if ($routeParams.id) {
            document.get(function (response) {
                loadedType = response.data.type
                $scope.data.document = response.data
                $scope.data.contractorId = $scope.data.document.contractorId
                if ($scope.data.document.contractorId) {
                    $http.get(apiBase + '/contractor/' + $scope.data.contractorId).then((response) => {
                        $scope.data.contractor = response.data
                    })
                }
                if (!$scope.data.document.products) {
                    $scope.data.document.products = []
                }
                angular.forEach($scope.data.document.products, (product) => {
                    product.vat = product.vat + ''
                    $scope.data.callcNet(product)
                })
                $scope.data.refreshResume()
                $scope.data.document.type = loadedType
                if ($routeParams.type == 'rw') {
                    $scope.data.document.kind = 'dec'
                    $scope.data.document.type = 'rw'
                } else if ($routeParams.type == 'pw') {
                    $scope.data.document.kind = 'add'
                    $scope.data.document.type = 'pw'
                }
                $scope.data.productionId = $routeParams.productionId
            }, $routeParams.id);
        } else {
            $http.get(apiBase + '/document/default').then((response) => {
                $scope.data.document.issuePlace = response.data.issuePlace
                $scope.data.document.bankName = response.data.bankName
                $scope.data.document.swift = response.data.bankSwift
                $scope.data.document.bankNumber = response.data.bankNumber
            })
        }
        $scope.data.productionId = $routeParams.productionId
        if ($routeParams.type == 'rw') {
            $scope.data.document.kind = 'dec'
            $scope.data.document.type = 'rw'
        }
        if (($routeParams.type == 'rw') || ($routeParams.type == 'pw')) {
            $http.get(apiBase + '/production/' + $routeParams.productionId).then((response) => {
                $scope.data.production = response.data;
            })
        }
        $scope.data.send = function () {
            $scope.data.validation.name = $scope.data.document.name ? false : true
            $scope.data.validation.date = $scope.data.document.date ? false : true
            $scope.data.validation.payDate = $scope.data.document.payDate ? false : true
            $scope.data.validation.issuePlace = $scope.data.document.issuePlace ? false : true
            $scope.data.validation.deliveryDate = $scope.data.document.deliveryDate ? false : true
            $scope.data.validation.payment = $scope.data.document.payment ? false : true
            validate = true
            angular.forEach($scope.data.validation, (el) => {
                if (el) {
                    validate = false
                }
            })
            if (!$scope.data.document.products.length > 0) {
                validate = false
            } else if (!$scope.data.contractorId && !$scope.data.productionId) {
                validate = false
            }
            if (!validate) {
                if ($scope.data.validation.name) {
                    showError.show($scope, 'Wprowadź numer dokumentu')
                } else if ($scope.data.validation.date) {
                    showError.show($scope, 'Wprowadź datę dokumentu')
                } else if ($scope.data.validation.payDate) {
                    showError.show($scope, 'Wprowadź datę zapłaty')
                } else if ($scope.data.validation.issuePlace) {
                    showError.show($scope, 'Wprowadź miejsce wystawienia')
                } else if ($scope.data.validation.deliveryDate) {
                    showError.show($scope, 'Wprowadź datę otrzymania')
                } else if (!$scope.data.document.products.length > 0) {
                    showError.show($scope, 'Wybierz jakieś produkty')
                } else if (!$scope.data.contractorId) {
                    showError.show($scope, 'Wybierz kontrahenta')
                } else if ($scope.data.validation.payment) {
                    if ((data.document.type === 'fvp') || (data.document.type === 'fvs')) {
                        showError.show($scope, 'Wybierz metodę płatności')
                    }
                }
                return
            }
            let data = $scope.data.document
            data.contractorId = $scope.data.contractorId
            data.cashDocument = $scope.data.cashDocument
            data.productionId = $routeParams.productionId
            if (data.id) {
                $http.put(apiBase + '/document/' + data.id, data).then(function (response) {
                    if (response.data.success) {
                        //$location.path('/katalog/produkty');
                    }
                });
                //$scope.messages = response.data.errors
            } else {
                $http.post(apiBase + '/document', data).then(function (response) {
                    if (response.data.id) {
                        $scope.data.id = response.data.id;
                        $location.path('/dokument/' + response.data.id, false);
                    }
                    //$scope.messages = response.data.errors
                });
            }
        }
        $scope.data.reloadContractor = () => {
            contractorSearch.get((response) => {
                $scope.data.contractors = response.data.contractors
            }, $scope.data.find.name, $scope.data.document.kind == 'add')
        }
        $scope.data.reloadProduct = () => {
            productSearch.get((response) => {
                $scope.data.products = response.data.products
            }, $scope.data.find.name)
        }
        $scope.data.reloadStock = () => {
            stockSearch.get((response) => {
                $scope.data.stocks = response.data.stocks
            }, $scope.data.find.name)
        }
        $scope.data.selectContractor = (contractor) => {
            $scope.data.contractorId = contractor.id
            $scope.data.contractorShow = false
            $scope.data.contractor = contractor
        }
        $scope.data.showSelectContractor = () => {
            $scope.data.contractorShow = true
            $scope.data.reloadContractor()
        }
        $scope.data.contractorHide = () => {
            $scope.data.contractorShow = false
        }
        $scope.data.productHide = () => {
            $scope.data.productShow = false
        }
        $scope.data.stockHide = () => {
            $scope.data.stockShow = false
        }
        $scope.data.showSelectProduct = () => {
            $scope.data.productShow = true
            $scope.data.reloadProduct()
        }
        $scope.data.showSelectStock = () => {
            $scope.data.stockShow = true
            $scope.data.reloadStock()
        }
        //$scope.data.reloadContractor()
        //$scope.data.reloadProduct()
        //$scope.data.reloadStock()
        $scope.data.selectProduct = (product) => {
            $scope.data.productShow = false
            product.count = 1
            product.vat = product.vat + ''
            product.productId = product.id
            delete product.id
            $scope.data.document.products.push(product)
            $scope.data.callcNet(product)
            $scope.data.refreshResume()
        }
        $scope.data.selectStock = (stock) => {
            $scope.data.stockShow = false
            stock.count = 1
            stock.vat = stock.vat + ''
            stock.productId = stock.id
            delete stock.id
            $scope.data.document.products.push(stock)
            $scope.data.callcNet(stock)
            $scope.data.refreshResume()
        }
        $scope.remove = (rows, row) => {
            row.deleted = true
        }
        $scope.data.callcNet = (product) => {
            net = (product.net + '').replace ? parseFloat((product.net + '').replace(',', '.')) : 0
            count = (product.count + '').replace ? parseFloat((product.count + '').replace(',', '.')) : 0
            product.sumNet = (net * count).toFixed(2)

            vat = product.vat
            product.sumVat = ((net * count) * (product.vat / 100)).toFixed(2)

            product.sumGross = ((net * count) + ((net * count) * (product.vat / 100))).toFixed(2)
            $scope.data.refreshResume()
        }
        $scope.data.callcSumNet = (product) => {
            sumNet = (product.sumNet + '').replace ? parseFloat((product.sumNet + '').replace(',', '.')) : 0
            count = (product.count + '').replace ? parseFloat((product.count + '').replace(',', '.')) : 0
            product.net = (sumNet / count).toFixed(2)

            vat = product.vat
            product.sumVat = (sumNet * (product.vat / 100)).toFixed(2)

            product.sumGross = (sumNet + (sumNet * (product.vat / 100))).toFixed(2)
            $scope.data.refreshResume()
            //$scope.data.callcNet()
        }
        $scope.data.callcSumGross = (product) => {
            sumGross = (product.sumGross + '').replace ? parseFloat((product.sumGross + '').replace(',', '.')) : 0
            count = (product.count + '').replace ? parseFloat((product.count + '').replace(',', '.')) : 0
            vat = product.vat
            product.sumVat = ((sumGross / (100 + parseFloat(product.vat))) * parseFloat(product.vat)).toFixed(2)
            product.sumNet = (sumGross - product.sumVat).toFixed(2)
            product.net = (product.sumNet / count).toFixed(2)
            $scope.data.refreshResume()
            //$scope.data.callcNet()
        }
        $scope.data.refreshResume = () => {
            sumNet = 0
            sumGross = 0
            angular.forEach($scope.data.document.products, (product) => {
                sumNet += parseFloat(product.sumNet)
                sumGross += parseFloat(product.net) * parseFloat(product.count) * (100 + parseFloat(product.vat)) / 100
            })
            $scope.data.document.sumNet = sumNet.toFixed(2)
            $scope.data.document.sumGross = sumGross.toFixed(2)
            $scope.data.document.tax = (sumGross - sumNet).toFixed(2)
            $scope.data.refreshSummary()
        }
        $scope.data.refreshSummary = () => {
            sumGross = 0
            angular.forEach($scope.data.document.products, (product) => {
                sumGross += parseFloat(product.net) * parseFloat(product.count) * (100 + parseFloat(product.vat)) / 100
            })
            if (!$scope.data.document.payed) {
                $scope.data.document.payed = sumGross.toFixed(2)
                $scope.data.document.toPay = 0
            }
            if (!$routeParams.id) {
                $scope.data.toPayRefresh()
            }
        }
        $scope.data.payedRefresh = () => {
            sumGross = 0
            angular.forEach($scope.data.document.products, (product) => {
                sumGross += parseFloat(product.net) * parseFloat(product.count) * (100 + parseFloat(product.vat)) / 100
            })
            $scope.data.document.toPay = (sumGross - parseFloat($scope.data.document.payed)).toFixed(2)
        }
        $scope.data.toPayRefresh = () => {
            sumGross = 0
            angular.forEach($scope.data.document.products, (product) => {
                sumGross += parseFloat(product.net) * parseFloat(product.count) * (100 + parseFloat(product.vat)) / 100
            })
            $scope.data.document.payed = (sumGross - parseFloat($scope.data.document.toPay)).toFixed(2)
        }
        $scope.$watch('data.document.kind', () => {
            //$scope.data.document.type = '';
            if ($scope.data.document.kind == 'add') {
                $scope.data.typeOption = [
                    {
                        name: 'Faktura zakupu',
                        value: 'fvp',
                    },
                    {
                        name: 'PZ',
                        value: 'pz',
                    },
                    {
                        name: 'PW',
                        value: 'pw',
                    },
                ]
            } else {
                $scope.data.typeOption = [
                    {
                        name: 'Faktura sprzedaż',
                        value: 'fvs',
                    },
                    {
                        name: 'WZ',
                        value: 'wz',
                    },
                    {
                        name: 'RW',
                        value: 'rw',
                    },
                ]
            }
            //alert(loadedType)
            $scope.data.document.type = loadedType
            if ($routeParams.type == 'rw') {
                $scope.data.document.kind = 'dec'
                $scope.data.document.type = 'rw'
            } else if ($routeParams.type == 'pw') {
                $scope.data.document.kind = 'add'
                $scope.data.document.type = 'pw'
            }
        })
        $scope.$watch('data.document.type', () => {
            if (!$routeParams.id && $scope.data.document.type) {
                $http.get(apiBase + '/document/number/' + $scope.data.document.type).then((response) => {
                    $scope.data.document.name = response.data.name
                    $scope.data.document.documentNumberId = response.data.documentNumberId
                })
            }
        })
    })

    .controller('documentsController', function ($rootScope, $scope, $http, documents, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        var filters = [];
        var filtersNames = [];
        $scope.documents = [];
        $rootScope.filters = filters;
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
            documents.get(function (response) {
                angular.forEach(response.data.documents, function (value, key) {
                    $scope.documents.push(value);
                });
                pagination = getData(pagination, response.data.pagination);
                filters = getData(filters, response.data.filters);
                filtersNames = getData(filtersNames, response.data.filtersNames);
                $rootScope.filters = filters;
                $rootScope.filtersNames = filtersNames;
            }, pagination, $rootScope.filters);
        }
        $scope.deleteRow = function (rows, row) {
            deleteDialog.show($scope, {
                title: 'Usunięcie dokumentu',
                templateUrl: '/Public/Template/Pl-pl/DeleteDialog.html',
                data: {
                    rows: rows,
                    row: row,
                    id: row.id,
                    apiUrl: '/document',
                }
            });
        }
        $scope.fluentLoad = function () {
            pagination.page++;
            loadPage();
        }
        loadPage();
        $rootScope.filterRefreshCallback = function () {
            $scope.documents = [];
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
            if ($scope.filters.date) {
                $rootScope.filters.push({
                    name: 'date',
                    kind: '%',
                    value: $scope.filters.date,
                })
            }
            $scope.documents = [];
            pagination.page = 1;
            loadPage()
        }
        $scope.deleteUrl = '/document'
    })

    .factory('document', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/document/' + id).then(callback);
            }
        }
    })

    .factory('documents', function ($http, $httpParamSerializerJQLike) {
        return {
            get: function (callback, pagination, filters) {
                var pagin = $httpParamSerializerJQLike({pagination: pagination});
                var filt = $httpParamSerializerJQLike({filters: filters});
                if (pagin) {
                    pagin += '&';
                }
                $http.get(apiBase + '/document?' + pagin + filt).then(callback);
            }
        }
    })