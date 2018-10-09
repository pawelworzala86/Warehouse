angular.module('Megazin')

    .factory('showError', function (modalDialog) {
        return {
            show: function (scope, message) {
                modalDialog.show(scope, {
                    title: '',
                    templateUrl: '/Public/Template/Pl-pl/ErrorDialog.html',
                    data: {
                        message: message
                    }
                })
            }
        }
    })

    .factory('modalDialog', ($http, $compile, $rootScope) => {
        return {
            show: (scopeFrom, options) => {
                if (!$rootScope.modalIndex) {
                    $rootScope.modalIndex = 100000
                }
                $rootScope.modalIndex++
                $http.get(options.templateUrl).then((response) => {
                    var node = angular.element(response.data)
                    var scope = scopeFrom.$new()
                    scope.modal = {}
                    scope.modal.close = () => {
                        node.remove()
                        angular.element(document.body).removeClass('modal')
                    }
                    scope.modal.title = options.title
                    scope.modal.message = options.title
                    if (options.accept) {
                        scope.modal.accept = () => {
                            angular.element(document.body).removeClass('modal')
                            options.accept(scope.data, node)
                        }
                    }
                    if (options.data) {
                        scope.data = options.data
                    }
                    scope.modal.zIndex = $rootScope.modalIndex
                    $compile(node.contents())(scope)
                    angular.element(document.body).append(node)
                    angular.element(document.body).addClass('modal')
                })
            }
        }
    })

    .factory('modalError', (modalDialog, $http, $compile, $rootScope) => {
        return {
            show: (scope, title) => {
                modalDialog.show(scope, {
                    title: title,
                    templateUrl: '/Public/Template/Pl-pl/ErrorDialog.html',
                })
            }
        }
    })

    .factory('deleteDialog', function ($http, modalDialog, $rootScope) {
        return {
            show: function (scope, options) {
                modalDialog.show(scope, {
                    title: options['title'] ? options.title : '',
                    templateUrl: '/Public/Template/Pl-pl/DeleteDialog.html',
                    data: options.data,
                    accept: (data, node) => {
                        if (data.id) {
                            $http.delete(apiBase + data.apiUrl + '/' + data.id, {id: data.id}).then(function (response) {
                                if (response.data.success) {
                                    node.remove()
                                    if (data.row) {
                                        data.row.deleted = true
                                    }
                                }
                            });
                        } else {
                            var ids = [];
                            angular.forEach($rootScope.selects, function (value, key) {
                                ids.push(value.id);
                            });
                            $http.post(apiBase + data.apiUrl + '/mass/delete', {ids: ids}).then(function (response) {
                                if (response.data.success) {
                                    angular.forEach(data.rows, function (value, key) {
                                        angular.forEach(data.row, function (v, k) {
                                            if (v.id == value.id)
                                                value.deleted = true
                                        })
                                    })
                                    node.remove()
                                    $rootScope.selects = []
                                }
                            });
                        }
                    }
                })
            }
        }
    })