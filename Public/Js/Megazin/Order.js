angular.module('Megazin')

    .controller('orderEditController', function (showError, $routeParams, $scope, $http, $location, order, contractorSearch, productSearch, stockSearch) {
        $scope.data = {
            id: $routeParams.id,
            document: {
                products: [],
                date: (date = new Date()).getFullYear() + '-' + ((month = (date.getMonth() + 1)) < 10 ? ('0' + month) : month) + '-' + date.getDate(),
            },
            validation: {
                name: true,
                date: true,
            },
            contractorShow: false,
            find: {
                name: '',
                date: '',
            },
            products: [],
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
            order.get(function (response) {
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
                //$scope.data.refreshResume()
                $scope.data.document.type = loadedType
            }, $routeParams.id);
        }
        $scope.data.send = function () {
            $scope.data.validation.name = $scope.data.document.name ? false : true
            $scope.data.validation.date = $scope.data.document.date ? false : true
            validate = true
            angular.forEach($scope.data.validation, (el) => {
                if (el) {
                    validate = false
                }
            })
            if (!$scope.data.document.products.length > 0) {
                validate = false
            } else if (!$scope.data.contractorId) {
                validate = false
            }
            if (!validate) {
                if ($scope.data.validation.name) {
                    showError.show($scope, 'Wprowadź numer dokumentu')
                } else if ($scope.data.validation.date) {
                    showError.show($scope, 'Wprowadź datę dokumentu')
                } else if (!$scope.data.document.products.length > 0) {
                    showError.show($scope, 'Wybierz jakieś produkty')
                } else if (!$scope.data.contractorId) {
                    showError.show($scope, 'Wybierz kontrahenta')
                }
                return
            }
            var data = $scope.data.document
            data.contractorId = $scope.data.contractorId
            if ($routeParams.id) {
                $http.put(apiBase + '/orders/' + $routeParams.id, data).then(function (response) {
                    if (response.data.success) {
                        //$location.path('/katalog/produkty');
                    }
                });
                //$scope.messages = response.data.errors
            } else {
                $http.post(apiBase + '/orders', data).then(function (response) {
                    if (response.data.id) {
                        $scope.data.id = response.data.id;
                        $location.path('/zamowienie/' + response.data.id, false);
                    }
                    //$scope.messages = response.data.errors
                });
            }
        }
        $scope.data.reloadContractor = () => {
            contractorSearch.get((response) => {
                $scope.data.contractors = response.data.contractors
            }, $scope.data.find.name, false)
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
            $scope.data.reloadProduct()
        }
        $scope.data.showSelectStock = () => {
            $scope.data.stockShow = true
            $scope.data.reloadStock()
        }
        //$scope.data.reloadContractor()
        //$scope.data.reloadProduct()
        //$scope.data.reloadStock()
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
            $scope.data.document.sumVat = (sumGross - sumNet).toFixed(2)
            $scope.data.refreshSummary()
        }
        $scope.data.refreshSummary = () => {
            sumGross = 0
            angular.forEach($scope.data.document.products, (product) => {
                sumGross += parseFloat(product.net) * parseFloat(product.count) * (100 + parseFloat(product.vat)) / 100
            })
        }
        if(!$routeParams.id) {
            $http.get(apiBase + '/document/number/ord').then((response) => {
                $scope.data.document.name = response.data.name
                $scope.data.document.documentNumberId = response.data.documentNumberId
            })
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.sku) {
                $rootScope.filters.push({
                    name: 'number',
                    kind: '%',
                    value: $scope.filters.number,
                })
            }
            $scope.orders = [];
            pagination.page = 1;
            loadPage()
        }
    })

    .controller('ordersController', function ($rootScope, $scope, $http, orders, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        var filters = [];
        var filtersNames = [];
        $scope.orders = [];
        $rootScope.filters = filters;
        $scope.filters = {
            number: '',
            date: '',
        }
        var getData = function (pagination, data) {
            if (data && (data.length > 0)) {
                return data;
            }
            return pagination
        }
        var loadPage = function () {
            orders.get(function (response) {
                //$scope.orders = []
                angular.forEach(response.data.orders, function (order, orderKey) {
                    angular.forEach(order.products, function (product, productKey) {
                        product.net = product.net.toFixed(2)
                        product.sumNet = product.sumNet.toFixed(2)
                        product.sumGross = product.sumGross.toFixed(2)
                        order.products[productKey] = product
                    });
                    $scope.orders.push(order);
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
            $scope.orders = [];
            pagination.page = 1;
            loadPage();
        }
        $scope.filter = () => {
            $rootScope.filters = []
            if ($scope.filters.number) {
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
            $scope.orders = [];
            pagination.page = 1;
            loadPage()
        }
        $scope.orderPrices = (order) => {
            $http.get(apiBase + '/orders/check/price').then((response) => {
                let prices = response.data.prices
                angular.forEach(prices, (value, key) => {
                    value.priceText = parseFloat(value.price).toFixed(2)
                    value.name = value.number
                })
                order.prices = prices
            })
        }
        $scope.orderAdd = (order) => {
            $http.post(apiBase + '/orders/add/' + order.id, {courier: $scope.lastSelected.service}).then((response) => {
                order.id = response.data.id
                order.courier = response.data.courier
                order.courierNumber = response.data.courierNumber
                order.courierPrice = response.data.courierPrice
            })
        }
        $scope.lastSelected = null
        $scope.selectPrice = (prices, price) => {
            angular.forEach(prices, (p) => {
                p.selected = false
            })
            price.selected = true
            $scope.lastSelected = price
        }
        $scope.addInvoice = (order) => {
            $http.put(apiBase + '/document/add/invoice/' + order.id).then((response) => {
                if (response.data.number) {
                    order.documentId = response.data.id
                    order.invoiceNumber = response.data.number
                }
            })
        }
        $scope.callOrders = () => {
            $http.get(apiBase + '/orders/call').then((response) => {
                angular.forEach(response.data.orders, (order) => {
                    angular.forEach($scope.orders, (o) => {
                        if (o.id == order.id) {
                            o.pickup = order.pickup
                        }
                    })
                })
            })
        }
        $scope.prestaDownload = () => {
            $http.get(apiBase + '/integration/presta/refresh').then((response) => {
            })
        }
    })

    .factory('orders', function ($http, $httpParamSerializerJQLike) {
        return {
            get: function (callback, pagination, filters) {
                var pagin = $httpParamSerializerJQLike({pagination: pagination});
                var filt = $httpParamSerializerJQLike({filters: filters});
                if (pagin) {
                    pagin += '&';
                }
                $http.get(apiBase + '/orders?' + pagin + filt).then(callback);
            }
        }
    })

    .factory('order', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/orders/' + id).then(callback);
            }
        }
    })