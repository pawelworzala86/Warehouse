angular.module('Megazin')

    .controller('userProfilController', function ($scope, userProfil, $http) {
        $scope.data = {
            profile: {}
        }
        userProfil.get(function (response) {
            $scope.data.profile = response.data
        })
        $scope.data.send = () => {
            $http.post(apiBase + '/user/profile', $scope.data.profile, (response) => {
            })
        }
    })

    .factory('userProfil', function ($http) {
        return {
            get: function (callback) {
                $http.get(apiBase + '/user/profile').then(callback);
            }
        }
    })