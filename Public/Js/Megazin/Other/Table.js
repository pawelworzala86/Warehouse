angular.module('Megazin')

    .controller('selectTableController', function (modalDialog, $rootScope, $scope, deleteDialog, $http) {
        $rootScope.selects = [];
        $scope.setSelectOptions = function (deleteUrl, titleField, itemsName) {
            $scope.deleteUrl = deleteUrl;
            $scope.titleField = titleField;
            $scope.itemsName = itemsName;
        }
        var removeFromSelect = function (index, row) {
            $rootScope.selects.splice(index, 1);
            var element = angular.element(document.querySelector('#chbx' + row.id));
            element.prop('checked', false);
            row.selected = false;
        }
        var removeFromRows = function (index, rows) {
            rows[index].selected = false;
        }
        var addToSelect = function (row) {
            var data = {
                id: row.id,
                name: row[$scope.titleField],
            }
            $rootScope.selects.push(data);
            var element = angular.element(document.querySelector('#chbx' + row.id));
            element.prop('checked', true);
            row.selected = true;
        }
        var findInSelect = function (rows, row) {
            var index = -1;
            angular.forEach(rows, function (value, key) {
                if (value.id == row.id) {
                    index = key;
                }
            });
            return index;
        }
        var addOrRemove = function (row) {
            var index = findInSelect($rootScope.selects, row);
            if (index < 0) {
                if (!row.deleted) {
                    addToSelect(row);
                }
            } else {
                removeFromSelect(index, row);
            }
        }
        $scope.checkAll = function (array) {
            angular.forEach(array, function (value, key) {
                addOrRemove(value);
            });
        }
        $scope.check = function (row) {
            addOrRemove(row);
        }
        $scope.delSelect = function (row, rows) {
            var index = findInSelect($rootScope.selects, row);
            removeFromSelect(index, row);
            var index = findInSelect(rows, row);
            if (index > -1) {
                rows[index].selected = false;
            }
        }
        $scope.clear = function (rows) {
            angular.forEach(rows, function (value, key) {
                if (value.selected) {
                    value.deleted = true;
                }
            });
        }
        $scope.massXls = function (rows) {
            var data = [];
            angular.forEach(rows, function (value, key) {
                data.push(value.id);
            });
            $http.post(apiBase + $scope.deleteUrl + '/mass/xls', {ids: data}).then(function (response) {
                var anchor = angular.element('<a/>');
                anchor.attr({
                    href: response.data.url,
                    target: '_blank',
                    download: response.data.name
                })[0].click();
            });
        }
        $scope.massPdf = function (rows) {
            var data = [];
            angular.forEach(rows, function (value, key) {
                data.push(value.id);
            });
            $http.post(apiBase + $scope.deleteUrl + '/mass/pdf', {ids: data}).then(function (response) {
                var anchor = angular.element('<a/>');
                anchor.attr({
                    href: response.data.url,
                    target: '_blank',
                    download: response.data.name
                })[0].click();
            });
        }
        $scope.massDelete = function (rows, row) {
            deleteDialog.show($scope, {
                title: 'Usunięcie wielu pozycji',
                data: {
                    rows: rows,
                    row: row,
                    apiUrl: $scope.deleteUrl
                },
            });
        }
        $scope.loadDetail = (url, products, product, template = null) => {
            //product.detail = true
            $http.get(apiBase + url + '/' + product.id).then(function (response) {
                //product.detail = response.data
                let dialogTemplate = url.substring(1)
                dialogTemplate = dialogTemplate.charAt(0).toUpperCase() + dialogTemplate.substring(1)
                if (template) {
                    //template = url.substring(1)
                    template = template.charAt(0).toUpperCase() + template.substring(1)
                }
                modalDialog.show($scope, {
                    title: '',
                    templateUrl: '/Public/Template/Pl-pl/' + (template ? template : dialogTemplate) + 'Dialog.html',
                    data: response.data
                })
            });
        }
        $scope.saveDetail = (url, detailRow) => {
            //product.detail = true
            $http.put(apiBase + url + '/' + detailRow.id, detailRow).then(function (response) {
                $scope.$parent.reload(detailRow)
            });
        }
    })