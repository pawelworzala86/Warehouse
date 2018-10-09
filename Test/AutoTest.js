var autoTest = function (container) {
    var cnt = $(container);
    Variables.load();
    var tests = {
        prepareRequest: function (requestHTML, fields, params) {
            $.each(fields, function (key, value) {
                var link = params.requestData[key].link;
                if (!params.requestData[key].value) {
                    requestHTML = requestHTML.replace('"<span', '<span');
                    requestHTML = requestHTML.replace('span>"', 'span>');
                }
                requestHTML = requestHTML.replace('"' + key + '"', '<span class="' + (link ? 'linked' : '') + '" data-type="' + value.type + '">' +
                    '<i class="material-icons link" data-key="' + key + '">link</i>' +
                    '"<b class="value">' + key + '</b>"</span>');
            });
            var requestHTMLObj = $(requestHTML);
            requestHTMLObj.find('i.link').click(function () {
                var html = Modals.links('Requests.' + params.name + 'Request.' + $(this).data('key'));
                Modal(html, {
                    close: function (modal) {
                        modal.close();
                    }
                });
            });
            return requestHTMLObj;
        },
        print: function (params) {
            var newCnt = $('<div class="test" data-params=\'' + JSON.stringify(params) + '\'>' +
                '<div class="row">' +
                '<i class="material-icons move">open_with</i>' +
                '<div class="methodName">' + params.name + '</div>' +
                '<div class="actions">' +
                //'<i class="material-icons">settings</i>' +
                '<i class="material-icons request">cloud_upload</i>' +
                '<i class="material-icons response">cloud_download</i>' +
                '<i class="material-icons status">cached</i>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>');
            tests.getRequest(params.name, function (requestName, request) {
                if (!params.requestData) {
                    var requestData = {};
                    var stringifyData = {};
                    var ajaxData = {};
                    $.each(request.fields, function (key, value) {
                        requestData[key] = Randomize.get('Requests', requestName, key, value.type);
                    });
                    $.each(requestData, function (key2, value2) {
                        var val = key2;
                        val = val.charAt(0).toLowerCase() + val.substr(1);
                        ajaxData[key2] = value2;
                        stringifyData[key2] = '<span class=\'Requests ' + requestName + ' ' + val + '\'>' + value2 + '</span>';
                        requestData[key2] = {
                            html: '<span class=\'Requests ' + requestName + ' ' + val + '\'>' + value2 + '</span>',
                            link: Variables.getLink('Requests.' + requestName + '.' + val),
                            value: value2,
                        };
                    });
                    params.requestData = requestData;
                    params.ajaxData = ajaxData;
                    params.stringifyData = stringifyData;
                }
                newCnt.find('.request').data('request', {
                    requestName: requestName,
                    request: request,
                    params: params,
                });
                var stringify = JSON.stringify(params.stringifyData, null, 4);
                if (stringify == '{}') {
                    newCnt.find('.request').css('display', 'none');
                }
            });
            newCnt.find('.request').click(function () {
                var request = $(this).data('request');
                var stringify = JSON.stringify(request.params.stringifyData, null, 4);
                var requestHTML = '<pre>' + stringify + '</pre>';
                requestHTML = tests.prepareRequest(requestHTML, request.request.fields, request.params);
                Modal(requestHTML, {
                    title: request.requestName + ' Json Data',
                    close: function (modal) {
                        modal.close();
                    }
                });
            });
            newCnt.find('.status').click(function () {
                var request = newCnt.find('.request').data('request');
                params.data = request.params.ajaxData;//requestData;
                Variables.set('Requests.' + request.requestName, request.params.ajaxData);
                tests.check(params, function (data, html, status) {
                    tests.getResponse(params.name, function (responseName, request) {
                        Variables.set('Responses.' + responseName, data);
                        Variables.save();
                        var responseData = {};
                        var prepereResponse = function(data, fields){
                            $.each(fields, function(key, value){
                                data[key] = fields[key];
                            });
                            return data;
                        }
                        responseData = prepereResponse(responseData, data);
                        newCnt.find('.response').data('response', {
                            data: responseData,
                            fields: request.fields,
                            responseName: responseName,
                            html: html,
                        });
                        newCnt.find('.response').css('display', 'inline-block');
                        var stringify = JSON.stringify(responseData, null, 4);
                        newCnt.find('.methodName').removeClass('error success');
                        if (stringify == '{}') {
                            newCnt.find('.methodName').addClass('error');
                        }else {
                            newCnt.find('.methodName').addClass('success');
                        }
                    });
                });
            });
            newCnt.find('.response').click(function () {
                var response = $(this).data('response');
                var stringify = JSON.stringify(response.data, null, 4);
                var responseHTML = '';
                if ((stringify == '{}')&&(response.html.length>0)) {
                    responseHTML = response.html;
                }else {
                    responseHTML = '<pre>' + stringify + '</pre>'
                };
                Modal(responseHTML, {
                    title: response.responseName + ' Json Data',
                    close: function (modal) {
                        modal.close();
                    }
                });
            });

            cnt.append(newCnt);
        },
        getResponse: function (name, callback) {
            $(tests.doc.routes).each(function () {
                if (this.name == name) {
                    callback(this.response, tests.doc.responses[this.response]);
                }
            });
        },
        getRequest: function (name, callback) {
            $(tests.doc.routes).each(function () {
                if (this.name == name) {
                    callback(this.request, tests.doc.requests[this.request]);
                }
            });
        },
        check: function (params, callback) {
            $.ajax({
                method: params.method,
                url: params.url,
                data: params.data,
            }).done(function (result) {
                var data = null;
                var error = false;
                try {
                    data = jQuery.parseJSON(result);
                } catch (e) {
                    data = null;
                }
                var html = '';
                if (data) {
                    html = $('<pre>' + JSON.stringify(data, null, 4) + '</pre>');
                } else {
                    html = result;
                }
                callback(data, html, data ? 'success' : 'error');
            });
        },
        start: function () {
            $.ajax({
                method: 'get',
                url: HOST + '/api/doc',
            }).done(function (result) {
                tests.doc = jQuery.parseJSON(result);
                //var lastPos = -1;
                var routes = {};
                $(tests.doc.routes).each(function () {
                    routes[this.name] = this;
                });
                var sortedRoutes = [];
                var sort = Variables.getSort();
                $(sort).each(function (key, value) {
                    sortedRoutes.push(routes[value]);
                });
                var sortedRoutesHave = function (name) {
                    var result = false;
                    $.each(sortedRoutes, function (key, value) {
                        if (value&&(value.name == name)) {
                            result = true;
                        }
                    });
                    return result;
                }
                $.each(routes, function (key, value) {
                    if (!sortedRoutesHave(value.name)) {
                        sortedRoutes.push(value);
                    }
                });
                var sortKeys = [];
                $.each(sortedRoutes, function (key, value) {
                    if (value) {
                        sortKeys.push(value.name);
                    }
                });
                Variables.setSort(sortKeys);
                Variables.save();
                $.each(sortedRoutes, function (key, value) {
                    if (value&&(!value.method)) {
                        return;
                    }
                    if (value) {
                        tests.print(value);
                    }
                });
                $('#autoTest').sortable({
                    update: function (event, ui) {
                        var sortKeys = [];
                        $('.test').each(function () {
                            sortKeys.push($(this).find('.methodName').text());
                        });
                        Variables.setSort(sortKeys);
                        Variables.save();
                    },
                    handle: 'i.move',
                });
                $('#autoTest').disableSelection();
            });
        }
    }
    return tests;
};