angular.module('Megazin')

    .controller('uploadController', function ($scope, $element, Upload, productImages, deleteDialog, $http) {
        $scope.files = [];
        $scope.deleteImage = function (rows, row) {
            deleteDialog.show({
                title: 'Usunięcie zdjęcia',
                templateUrl: '/Public/Template/Pl-pl/DeleteDialog.html',
                apiUrl: '/catalog/product/' + $scope.$parent.data.id + '/image/',
                data: {
                    rows: rows,
                    row: row,
                }
            });
        }
        if ($scope.$parent.data.id) {
            productImages.get(function (response) {
                $scope.files = response.data.files;
            }, $scope.$parent.data.id);
        }
        $scope.drop = function (e) {
            $scope.submit();
        }
        $scope.select = function (event) {
            $scope.submit();
            event.preventDefault();
        }
        $scope.submit = function () {
            $scope.upload($scope.file);
        };
        $scope.abort = function (event) {
            if ($scope.xhr) {
                $scope.xhr.abort();
            }
            $scope.uploading = false;
            event ? event.preventDefault() : {};
        };
        $scope.upload = function (file) {
            var files = [];
            angular.forEach(file, function (value, key) {
                files.push(value);
                var fileReader = new FileReader();
                fileReader.readAsDataURL(value);
                fileReader.onload = function (e) {
                    var dataUrl = e.target.result;
                    var name = value.name;
                    var type = value.type;
                    var base64Data = dataUrl.substr(dataUrl.indexOf('base64,') + 'base64,'.length);
                    $scope.uploading = true;
                    Upload.upload({
                        url: apiBase + '/files/upload',
                        data: {
                            file: [{
                                name: name,
                                type: type,
                                data: base64Data,
                            }]
                        }
                    }).success(function (resp) {
                        angular.forEach(resp.file, function (value, key) {
                            $http.put(apiBase + '/catalog/product/' + $scope.$parent.data.id + '/image/' + value.id).then(function () {
                                if (!$scope.files) {
                                    $scope.files = [];
                                }
                                $scope.files.push(value);
                            });
                        });
                        $scope.abort();
                    }).error(function (resp) {
                    }).progress(function (evt) {
                        $scope.progress = (parseFloat(Math.round(100 * (evt.loaded / evt.total)))).toFixed(2) + '%';
                    }).xhr(function (e, xhr) {
                        $scope.xhr = xhr;
                    });
                    ;
                }
            });
        };
    })

    .controller('uploadAttachmentController', function (productAttachments, $scope, $element, Upload, productImages, deleteDialog, $http) {
        $scope.files = [];
        $scope.setSelectOptions = function (deleteUrl, titleField, itemsName) {
            $scope.deleteUrl = deleteUrl;
            $scope.titleField = titleField;
            $scope.itemsName = itemsName;
        }
        $scope.deleteAttachment = function (rows, row) {
            deleteDialog.show($scope, {
                title: 'Usunięcie załącznika',
                templateUrl: '/Public/Template/Pl-pl/DeleteDialog.html',
                data: {
                    id: row.id,
                    row: row,
                    apiUrl: $scope.deleteUrl + $scope.$parent.data.product.id + '/attachment',
                },
                accept: (data, node) => {
                    data.row.remove()
                }
            });
        }
        if ($scope.$parent.data.id) {
            productAttachments.get(function (response) {
                $scope.files = response.data.files;
            }, $scope.$parent.data.id);
        }
        $scope.drop = function (e) {
            $scope.submit();
        }
        $scope.select = function (event) {
            $scope.submit();
            event.preventDefault();
        }
        $scope.submit = function () {
            $scope.upload($scope.file);
        };
        $scope.abort = function (event) {
            if ($scope.xhr) {
                $scope.xhr.abort();
            }
            $scope.uploading = false;
            event ? event.preventDefault() : {};
        };
        $scope.upload = function (file) {
            var files = [];
            angular.forEach(file, function (value, key) {
                files.push(value);
                var fileReader = new FileReader();
                fileReader.readAsDataURL(value);
                fileReader.onload = function (e) {
                    var dataUrl = e.target.result;
                    var name = value.name;
                    var type = value.type;
                    var base64Data = dataUrl.substr(dataUrl.indexOf('base64,') + 'base64,'.length);
                    $scope.uploading = true;
                    Upload.upload({
                        url: apiBase + '/files/upload',
                        data: {
                            file: [{
                                name: name,
                                type: type,
                                data: base64Data,
                            }]
                        }
                    }).success(function (resp) {
                        angular.forEach(resp.file, function (value, key) {
                            $http.put(apiBase + '/catalog/product/' + $scope.$parent.data.id + '/attachment/' + value.id).then(function () {
                                if (!$scope.files) {
                                    $scope.files = [];
                                }
                                $scope.files.push(value);
                            });
                        });
                        $scope.abort();
                    }).error(function (resp) {
                    }).progress(function (evt) {
                        $scope.progress = (parseFloat(Math.round(100 * (evt.loaded / evt.total)))).toFixed(2) + '%';
                    }).xhr(function (e, xhr) {
                        $scope.xhr = xhr;
                    });
                    ;
                }
            });
        };
    })

    .directive('upload', function ($rootScope) {
        return {
            restrict: 'E',
            scope: {
                data: '=data'
            },
            templateUrl: '/Public/Template/Pl-pl/UploadImage.html',
            controller: 'uploadController',
        }
    })

    .directive('uploadAttachment', function ($rootScope) {
        return {
            restrict: 'E',
            scope: {
                data: '=data'
            },
            templateUrl: '/Public/Template/Pl-pl/UploadAttachment.html',
            controller: 'uploadAttachmentController',
        }
    })