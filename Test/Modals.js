var Modals = {
    links: function(linkName) {
        var content = $('<div id="modalLinks"><div class="requests"><div class="title">Requests</div></div>' +
            '<div class="responses"><div class="title">Responses</div></div></div>');
        var requests = Variables.getAllByString('Requests');
        var responses = Variables.getAllByString('Responses');
        var forEach = function(requests, title, cnt) {
            $.each(requests, function (key, value) {
                var html = $('<div class="data" data-data=\'' + JSON.stringify({key: key, value: value}) + '\'></div>');
                html.append($('<div class="methodTitle">' + key.replace(title, '') + '</div>'));
                var values = $('<div class="values"></div>');
                $.each(value, function (key, value) {
                    values.append($('<div class="value" data-key="'+key+'">' + key + '</div>'));
                });
                html.append(values);
                values.find('.value').unbind().click(function(){
                    var linkValue = $(this).parents('.data').data('data').key;
                    linkValue += '.'+$(this).data('key');
                    Variables.setLink(linkName, linkValue)
                    Variables.save();
                    $('.'+linkName).text(Variables.get(linkValue));
                    $('.'+linkName).prev().addClass('linked');
                    content.parents('.window').data('hWnd').close();
                });
                content.find(cnt).append(html);
            });
        }
        forEach(requests, 'Requests.', '.requests');
        forEach(responses, 'Responses.', '.responses');
        return content;
    },
    request: function(){
        var content = $('<div id="modalRequest">sdfsdf</div>');
        return content;
    }
}