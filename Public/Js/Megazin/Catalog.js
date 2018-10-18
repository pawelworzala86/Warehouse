angular.module('Megazin')

    .controller('catalogCategoriesController', function (modalError, modalDialog, showError, $scope, $http, catalogCategories, deleteDialog) {
        $scope.categories = [];
        catalogCategories.get(function (response) {
            $scope.categories = response.data.categories ? response.data.categories : [];
        })
        $scope.add = function (item, items) {
            modalDialog.show($scope, {
                title: 'Dodawanie nowej kategorii do katalogu',
                templateUrl: '/Public/Template/Pl-pl/Catalog/AddCategoryDialog.html',
                accept: (data, node) => {
                    if (!data || !data.name) {
                        modalError.show($scope, 'Wprowadź nazwę kategorii')
                        return
                    }
                    $http.post(apiBase + '/catalog/category', data).then(function (response) {
                        $scope.categories.push({
                            id: response.data.id,
                            name: data.name,
                            parentId: data.parentId,
                            categories: [],
                        });
                        node.remove()
                    });
                }
            })
        }
        $scope.treeOptions = {
            beforeDrop: function (event) {
                var index = event.dest.index;
                var categoryId = event.source.nodeScope.$modelValue.id;
                var name = event.source.nodeScope.$modelValue.name;
                var parentId = null;
                if (event.dest.nodesScope.$parent.$modelValue) {
                    parentId = event.dest.nodesScope.$parent.$modelValue.id;
                }
                $http.put(apiBase + '/catalog/category/' + categoryId, {
                    name: name,
                    lp: index + 1,
                    parentId: parentId,
                }).then(function (response) {
                });
                return true;
            },
        };
        $scope.edit = function (element) {
            modalDialog.show($scope, {
                title: 'Dodawanie nowej kategorii do katalogu',
                templateUrl: '/Public/Template/Pl-pl/Catalog/AddCategoryDialog.html',
                data: element,
                accept: (data, node) => {
                    $http.put(apiBase + '/catalog/category/' + element.id, {
                        id: data.id,
                        name: data.name,
                        parentId: data.parentId,
                    }).then(function (response) {
                        element.name = data.name;
                        node.remove()
                    });
                }
            })
        }
    })

    .controller('catalogEditProductController', function (showError, $routeParams, $scope, $http, $location, catalogProduct, $compile) {
        $scope.data = {
            id: $routeParams.id,
            product: {
                toSell: true,
                vat: '23'
            },
            validation: {
                sku: true,
                name: true,
                sellNet: true,
                sellGross: true,
                vat: true,
            }
        }
        $scope.data.vatRates = [
            {
                name: '23%',
                value: 23
            },
            {
                name: '8%',
                value: 8
            },
            {
                name: '5%',
                value: 5
            },
            {
                name: '0%',
                value: 0
            },
            {
                name: 'zw',
                value: 0
            }
        ]
        if ($routeParams.id) {
            catalogProduct.get(function (response) {
                $scope.data.product = response.data;
                $scope.data.product.vat = $scope.data.product.vat + ''
            }, $routeParams.id);
        }
        $scope.data.send = function () {
            $scope.data.validation.name = $scope.data.product.name ? false : true
            $scope.data.validation.sku = $scope.data.product.sku ? false : true
            $scope.data.validation.sellNet = $scope.data.product.sellNet ? false : true
            $scope.data.validation.sellGross = $scope.data.product.sellGross ? false : true
            $scope.data.validation.vat = $scope.data.product.vat ? false : true
            validate = true
            angular.forEach($scope.data.validation, (el) => {
                if (el) {
                    validate = false
                }
            })
            if (!validate) {
                if ($scope.data.validation.sku) {
                    showError.show($scope, 'Wprowadź kod SKU')
                } else if ($scope.data.validation.name) {
                    showError.show($scope, 'Wprowadź nazwę towaru')
                } else if ($scope.data.validation.sellNet) {
                    showError.show($scope, 'Wprowadź cenę sprzedaży netto')
                } else if ($scope.data.validation.sellGross) {
                    showError.show($scope, 'Wprowadź cenę sprzedaży brutto')
                } else if ($scope.data.validation.vat) {
                    showError.show($scope, 'Wybierz stawkę VAT')
                }
                return
            }
            var data = $scope.data.product;
            if ($routeParams.id) {
                $http.put(apiBase + '/catalog/product/' + $routeParams.id, data).then(function (response) {
                    if (response.data.success) {
                        $location.path('/katalog/produkty');
                    }
                });
                //$scope.messages = response.data.errors
            } else {
                $http.post(apiBase + '/catalog/product', data).then(function (response) {
                    if (response.data.id) {
                        $scope.data.id = response.data.id;
                        //$location.path('/katalog/produkt/' + response.data.id, false);
                        $location.path('/katalog/produkty');
                    }
                    //$scope.messages = response.data.errors
                });
            }
        }
        $scope.tabs = [
            {id: 1, name: 'Podstawowe', templateUrl: '/Public/Template/Pl-pl/Catalog/Product/CardBasic.html'},
            {id: 2, name: 'Ceny', templateUrl: '/Public/Template/Pl-pl/Catalog/Product/CardPrice.html'},
            {id: 3, name: 'Opisy', templateUrl: '/Public/Template/Pl-pl/Catalog/Product/CardDescription.html'},
            {
                id: 4,
                name: 'Zdjęcia',
                templateUrl: '/Public/Template/Pl-pl/Catalog/Product/CardPhotos.html',
                idRequired: true
            },
            {
                id: 5,
                name: 'Załączniki',
                templateUrl: '/Public/Template/Pl-pl/Catalog/Product/CardAttachments.html',
                idRequired: true
            },
            {id: 6, name: 'Dostawcy', disable: true}
        ];
        $scope.imagesUploadOptions = {}
        $scope.attachmentsUploadOptions = {}
        buyCalcBlock = false
        $scope.data.sellCalc = (fromNet = false) => {
            buyCalcBlock = true
            if (fromNet) {
                if (!$scope.data.product.sellNet) {
                    sellCalcBlock = false
                    return
                }
                net = parseFloat(('' + $scope.data.product.sellNet).replace(',', '.'))
                vat = $scope.data.product.vat
                vat = (100 + parseFloat(vat)) / 100
                gross = Math.round(net * vat * 100) / 100
                $scope.data.product.sellGross = gross.toFixed(2)
            } else {
                if (!$scope.data.product.sellGross) {
                    sellCalcBlock = false
                    return
                }
                gross = parseFloat(('' + $scope.data.product.sellGross).replace(',', '.'))
                vat = $scope.data.product.vat
                vat = 100 / (100 + parseFloat(vat))
                net = Math.round(gross * vat * 100) / 100
                $scope.data.product.sellNet = net.toFixed(2)
            }
            sellCalcBlock = false
        }
    })

    .controller('catalogProductsController', function ($rootScope, $scope, $http, catalogProducts, deleteDialog) {
        var pagination = {
            page: 1,
            limit: 20,
        };
        $scope.products = [];
        $rootScope.filters = [];
        $scope.filters = {
            sku: '',
            name: '',
        }
        var getData = function (pagination, data) {
            if (data && (data.length > 0)) {
                return data;
            }
            return pagination
        }
        var loadPage = function () {
            catalogProducts.get(function (response) {
                angular.forEach(response.data.products, function (value, key) {
                    if(value.net) {
                        value.net = value.net.toFixed(2)
                    }
                    $scope.products.push(value);
                });
                pagination = getData(pagination, response.data.pagination);
            }, pagination, $rootScope.filters);
        }
        $scope.reload = (row) => {
            angular.forEach($scope.products, function (value, key) {
                if (value.id == row.id) {
                    value.sku = row.sku
                    value.name = row.name
                }
            });
        }
        $scope.deleteRow = function (rows, row) {
            deleteDialog.show($scope, {
                title: 'Usunięcie produktu',
                data: {
                    rows: rows,
                    row: row,
                    id: row.id,
                    apiUrl: '/catalog/product'
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
            if ($scope.filters.sku) {
                $rootScope.filters.push({
                    name: 'sku',
                    kind: '%',
                    value: $scope.filters.sku,
                })
            }
            if ($scope.filters.name) {
                $rootScope.filters.push({
                    name: 'name',
                    kind: '%',
                    value: $scope.filters.name,
                })
            }
            $scope.products = [];
            pagination.page = 1;
            loadPage()
        }
        $scope.synchronizeProducts = ()=>{
            $http.put(apiBase+'/integration/presta/synchronize').then(()=>{})
        }
        $scope.allegroSend = (product)=>{
            $http.get(apiBase+'/integration/allegro/send/'+product.id).then(()=>{})
        }
    })

    .factory('productSearch', function ($http) {
        return {
            get: function (callback, search) {
                $http.post(apiBase + '/catalog/product/search', {search: search}).then(callback);
            }
        }
    })

    .factory('productImages', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/catalog/product/' + id + '/image').then(callback);
            }
        }
    })

    .factory('productAttachments', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/catalog/product/' + id + '/attachment').then(callback);
            }
        }
    })

    .factory('catalogProduct', function ($http) {
        return {
            get: function (callback, id) {
                $http.get(apiBase + '/catalog/product/' + id).then(callback);
            }
        }
    })

    .factory('catalogCategories', function ($http) {
        return {
            get: function (callback) {
                $http.get(apiBase + '/catalog/category').then(callback);
            }
        }
    })

    .factory('catalogProducts', function ($http, $httpParamSerializerJQLike) {
        return {
            get: function (callback, pagination, filters) {
                var pagin = $httpParamSerializerJQLike({pagination: pagination});
                var filt = $httpParamSerializerJQLike({filters: filters});
                if (pagin) {
                    pagin += '&';
                }
                $http.get(apiBase + '/catalog/product?' + pagin + filt).then(callback);
            }
        }
    })