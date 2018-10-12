angular.module('Megazin')

    .controller('registerController', function ($scope, $location, $http) {
        $scope.send = function () {
            $http.post(apiBase + '/user/register', {
                mail: $scope.mail,
                password: $scope.password,
            }).then(function (response) {
                if (response.data.code) {
                    $location.path('/konto/zarejestrowano');
                }
            });
        }
    })

    .controller('loginController', function ($scope, $location, $http, $rootScope) {
        $scope.send = function () {
            $http.post(apiBase + '/user/login', {
                mail: $scope.mail,
                password: $scope.password,
            }).then(function (response) {
                if (response.data.success) {
                    $rootScope.user.logged = true;
                    $location.path('/panel');
                } else {
                    $scope.messages = response.data.messages
                }
            });
        }
    })

    .controller('afterRegisterController', function ($scope, $location, $http) {
    })

    .controller('accountActivateController', function ($scope, $location, $http, activateAccount, $routeParams) {
        activateAccount.get(function (response) {
            console.log(response);
        }, $routeParams.code, $routeParams.confirmationCode);
    })

    .factory('activateAccount', function ($http) {
        return {
            get: function (callback, code, confirmationCode) {
                $http.get(apiBase + '/user/register/' + code + '/confirm/' + confirmationCode).then(callback);
            }
        }
    })