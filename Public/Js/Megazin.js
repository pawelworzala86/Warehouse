var base = '';
var apiBase = '/api';
var templateBase = '/Public/Template/Pl-pl/';

angular.module('Megazin', ['ngRoute', 'ui.tree', 'ngFileUpload'])

    .config(function ($routeProvider, $locationProvider, $compileProvider, $httpProvider) {
        $routeProvider
            .when(base + '/', {
                templateUrl: templateBase + 'Landing.html',
                controller: 'landingController',
            })
            .when(base + '/konto/rejestracja', {
                templateUrl: templateBase + 'User/Register.html',
                controller: 'registerController',
            })
            .when(base + '/konto/zarejestrowano', {
                templateUrl: templateBase + 'User/AfterRegister.html',
                controller: 'afterRegisterController',
            })
            .when(base + '/konto/:code/aktywuj/:confirmationCode', {
                templateUrl: templateBase + 'User/AccountActivate.html',
                controller: 'accountActivateController',
            })
            .when(base + '/konto/logowanie', {
                templateUrl: templateBase + 'User/Login.html',
                controller: 'loginController',
            })
            .when(base + '/katalog/kategorie', {
                templateUrl: templateBase + 'Catalog/Categories.html',
                controller: 'catalogCategoriesController',
                pageName: 'Kategorie produktów',
                logged: true,
            })
            .when(base + '/katalog/produkty', {
                templateUrl: templateBase + 'Catalog/Products.html',
                controller: 'catalogProductsController',
                pageName: 'Lista produktów',
                logged: true,
            })
            .when(base + '/katalog/produkt/dodaj', {
                templateUrl: templateBase + 'Catalog/AddProduct.html',
                controller: 'catalogEditProductController',
                pageName: 'Dodawanie produktu',
                logged: true,
            })
            .when(base + '/katalog/produkt/:id', {
                templateUrl: templateBase + 'Catalog/AddProduct.html',
                controller: 'catalogEditProductController',
                pageName: 'Edycja produktu',
                logged: true,
            })
            .when(base + '/konto/profil', {
                templateUrl: templateBase + 'User/Profile.html',
                controller: 'userProfilController',
                pageName: 'Profil użytkownika',
                logged: true,
            })
            .when(base + '/system/pliki', {
                templateUrl: templateBase + 'System/Files.html',
                controller: 'systemFilesController',
                pageName: 'Twoje pliki',
                logged: true,
            })
            .when(base + '/dokumenty', {
                templateUrl: templateBase + 'Documents.html',
                controller: 'documentsController',
                pageName: 'Lista dokumentów',
                logged: true,
            })
            .when(base + '/dokument/dodaj', {
                templateUrl: templateBase + 'Document-Edit.html',
                controller: 'documentEditController',
                pageName: 'Edycja dokumentu',
                logged: true,
            })
            .when(base + '/dokument/:id', {
                templateUrl: templateBase + 'Document-Edit.html',
                controller: 'documentEditController',
                pageName: 'Edycja dokumentu',
                logged: true,
            })
            .when(base + '/dokument/dodaj/produkcja/:productionId/:type', {
                templateUrl: templateBase + 'Document-Edit.html',
                controller: 'documentEditController',
                pageName: 'Wydanie na produkcję',
                logged: true,
            })
            .when(base + '/kontrahenci', {
                templateUrl: templateBase + 'Contractors.html',
                controller: 'contractorsController',
                pageName: 'Lista kontrahentów',
                logged: true,
            })
            .when(base + '/kontrahent/dodaj', {
                templateUrl: templateBase + 'Contractor-Edit.html',
                controller: 'contractorEditController',
                pageName: 'Edycja kontrahenta',
                logged: true,
            })
            .when(base + '/kontrahent/:id', {
                templateUrl: templateBase + 'Contractor-Edit.html',
                controller: 'contractorEditController',
                pageName: 'Edycja kontrahenta',
                logged: true,
            })
            .when(base + '/magazyn', {
                templateUrl: templateBase + 'Stocks.html',
                controller: 'stocksController',
                pageName: 'Stan towarów',
                logged: true,
            })
            .when(base + '/zamowienia', {
                templateUrl: templateBase + 'Orders.html',
                controller: 'ordersController',
                pageName: 'Lista zamówień',
                logged: true,
            })
            .when(base + '/zamowienie/dodaj', {
                templateUrl: templateBase + 'Order-Edit.html',
                controller: 'orderEditController',
                pageName: 'Dodawanie zamówienia',
                logged: true,
            })
            .when(base + '/zamowienie/:id', {
                templateUrl: templateBase + 'Order-Edit.html',
                controller: 'orderEditController',
                pageName: 'Edycja zamówienia',
                logged: true,
            })
            .when(base + '/dluznicy', {
                templateUrl: templateBase + 'Debtors.html',
                controller: 'debtorsController',
                pageName: 'Lista dłużników',
                logged: true,
            })
            .when(base + '/produkcje', {
                templateUrl: templateBase + 'Productions.html',
                controller: 'productionsController',
                pageName: 'Lista produkcji',
                logged: true,
            })
            .when(base + '/produkcja/dodaj', {
                templateUrl: templateBase + 'Production-Edit.html',
                controller: 'productionEditController',
                pageName: 'Dodawanie produkcji',
                logged: true,
            })
            .when(base + '/produkcja/:id', {
                templateUrl: templateBase + 'Production-Edit.html',
                controller: 'productionEditController',
                pageName: 'Edycja produkcji',
                logged: true,
            })
            .when(base + '/kasa', {
                templateUrl: templateBase + 'Cash.html',
                controller: 'cashsController',
                pageName: 'Stan kasy',
                logged: true,
            })
            .when(base + '/kasa/dodaj', {
                templateUrl: templateBase + 'Cash-Edit.html',
                controller: 'cashEditController',
                pageName: 'Edycja dokumentu kasowego',
                logged: true,
            })
            .when(base + '/kasa/:id', {
                templateUrl: templateBase + 'Cash-Edit.html',
                controller: 'cashEditController',
                pageName: 'Edycja dokumentu kasowego',
                logged: true,
            })
            .when(base + '/kanaly-sprzedazy', {
                templateUrl: templateBase + 'Channels.html',
                controller: 'channelsController',
                pageName: 'Kanały sprzedaży',
                logged: true,
            })
            .when(base + '/kanal-sprzedazy/dodaj', {
                templateUrl: templateBase + 'Channel-Edit.html',
                controller: 'channelEditController',
                pageName: 'Edycja kanału sprzedaży',
                logged: true,
            })
            .when(base + '/kanal-sprzedazy/:id', {
                templateUrl: templateBase + 'Channel-Edit.html',
                controller: 'channelEditController',
                pageName: 'Edycja kanału sprzedaży',
                logged: true,
            })
            .when(base + '/demo', {
                templateUrl: templateBase + 'Demo.html',
                controller: 'demoController',
                pageName: 'Ustawienia demonstracyjne',
                logged: true,
            })
            .when(base + '/finanse', {
                templateUrl: templateBase + 'Financials.html',
                controller: 'financialsController',
                pageName: 'Operacje finansowe',
                logged: true,
            })
            .when(base + '/finanse/dodaj', {
                templateUrl: templateBase + 'Financial-Edit.html',
                controller: 'financialEditController',
                pageName: 'Edycja operacji finansowej',
                logged: true,
            })
            .when(base + '/finanse/:id', {
                templateUrl: templateBase + 'Financial-Edit.html',
                controller: 'financialEditController',
                pageName: 'Edycja operacji finansowej',
                logged: true,
            })
        ;

        $locationProvider.html5Mode({
            enabled: true,
            requireBase: false
        });
        $compileProvider.debugInfoEnabled(true);
        delete $httpProvider.defaults.headers.common['X-Requested-With'];
        $httpProvider.defaults.useXDomain = true;
        $httpProvider.defaults.withCredentials = true;
    })

    .run(function ($rootScope, $http, $location, $route) {
        $rootScope.showFilter = false;
        $rootScope.showMenu = false;
        $rootScope.pageName = null;
        $rootScope.baseUrl = base;
        $rootScope.user = {
            logged: false,
        }
        $rootScope.logout = function () {
            $http.get(apiBase + '/user/logout').then(function (response) {
                if (response.data.success) {
                    $rootScope.user.logged = false;
                    $location.path('/');
                }
            });
        }

        $http.get(apiBase + '/user/status').then(function (response) {
            $rootScope.user = {
                logged: response.data.logged,
            };
        });
        $rootScope.$on('$routeChangeStart', function ($event, next, current) {
            $rootScope.selects = []
            $rootScope.filters = [];
            $rootScope.filtersNames = [];
            if (next.logged && !$rootScope.user.logged) {
                $event.preventDefault();
                return false;
            }
            $rootScope.pageName = next.pageName;
        });
        $rootScope.$on('$locationChangeStart', function(event, next, current) {
            if (next.logged && !$rootScope.user.logged) {
                event.preventDefault();
            }
        });
        $rootScope.formatSizeUnits = function (bytes) {
            if (bytes >= 1073741824) {
                bytes = (bytes / 1073741824).toFixed(2) + ' GB';
            }
            else if (bytes >= 1048576) {
                bytes = (bytes / 1048576).toFixed(2) + ' MB';
            }
            else if (bytes >= 1024) {
                bytes = (bytes / 1024).toFixed(2) + ' KB';
            }
            else if (bytes > 1) {
                bytes = bytes + ' b';
            }
            else if (bytes == 1) {
                bytes = bytes + ' b';
            }
            else {
                bytes = '0 b';
            }
            return bytes;
        }
        var original = $location.path;
        $location.path = function (path, reload) {
            if (reload === false) {
                var lastRoute = $route.current;
                var un = $rootScope.$on('$locationChangeSuccess', function () {
                    $route.current = lastRoute;
                    un();
                });
            }
            return original.apply($location, [path]);
        };
    })

    .controller('landingController', function ($scope) {
    })

    .controller('demoController', function ($scope, $http) {
        $scope.progressBar = 0;
        $scope.contractors = 100
        $scope.products = 100
        $scope.documents = 100
        $scope.orders = 100
        $scope.max = $scope.contractors + $scope.products + $scope.documents + $scope.orders;
        $scope.progress = 1;
        $scope.setProgress = () => {
            $scope.progressBar = (($scope.progress++) / $scope.max) * 100;
        }
        $scope.clear = () => {
            $http.get(apiBase + '/demo/clear').then(() => {
                $scope.setProgress()
            })
        }
        $scope.contractor = () => {
            for (i = 0; i < $scope.contractors; i++) {
                $http.get(apiBase + '/demo/generate/contractor').then(() => {
                    $scope.setProgress()
                })
            }
        }
        $scope.product = () => {
            for (i = 0; i < $scope.products; i++) {
                $http.get(apiBase + '/demo/generate/product').then(() => {
                    $scope.setProgress()
                })
            }
        }
        $scope.document = () => {
            for (i = 0; i < $scope.documents; i++) {
                $http.get(apiBase + '/demo/generate/document').then(() => {
                    $scope.setProgress()
                })
            }
        }
        $scope.order = () => {
            for (i = 0; i < $scope.orders; i++) {
                $http.get(apiBase + '/demo/generate/order').then(() => {
                    $scope.setProgress()
                })
            }
        }
        $scope.genere = () => {
            $http.get(apiBase + '/demo/clear').then(() => {
                $scope.contractor()
                $scope.product()
                $scope.document()
                $scope.order()
            })
        }
    })
;