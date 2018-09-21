var collection = [];

var modal = function (container) {
    container = $(container);
    container.click(function () {
        container.removeClass('visible');
    });
    container.find('.container').click(function (e) {
        e.preventDefault();
        return false;
    });
}

var url = window.location.href.toString();
var fluentLoaderUrl = url.replace('http://' + window.location.host + '/', '');
var fluentLoaderPage = 2;
var fluentLoaderWork = false;
var fluentLoaderTimeout = 500;
var fluentLoader = function () {
    if ($(document.body).height() < $(window).height()) {
        loadContent($('#wrapper .content'), !empty(fluentLoaderUrl) ? (fluentLoaderUrl + '/' + fluentLoaderPage) : false, true, true, false);
        return;
    }
    if (($(document.body).height() - $(window).height() - $(window).scrollTop()) < 50) {
        loadContent($('#wrapper .content'), !empty(fluentLoaderUrl) ? (fluentLoaderUrl + '/' + fluentLoaderPage) : false, true, true, false);
    } else {
        fluentLoaderWork = false;
    }
}
$(window).scroll(function () {
    if (($(document.body).height() - $(window).height() - $(window).scrollTop()) < 50) {
        if (!fluentLoaderWork) {
            fluentLoaderWork = true;
            loadContent($('#wrapper .content'), !empty(fluentLoaderUrl) ? (fluentLoaderUrl + '/' + fluentLoaderPage) : false, true, true, false);
        }
    }
});

var loadContent = function (container, url, notPushToHistory = false, notOverride = false, heading = true) {
    if ((url == '') || (url == undefined) || (url == false)) {
        return;
    }
    if (!notPushToHistory) {
        history.pushState({url: url}, url, url);
    }
    collection = [];
    if (!notOverride) {
        $(container).html('<i class="material-icons rotate big">refresh</i>');
    }
    $.ajax({
        url: url,
        method: 'POST',
        data: {
            ajax: true,
            heading: heading,
        }
    }).done(function (data) {
        if (notOverride) {
            var data = $.parseJSON(data);
            var newContents = $(data.html);
            var url = window.location.href.toString();
            fluentLoaderUrl = url.replace('http://' + window.location.host + '/', '');
            if (data.fluentLoader || ($(newContents).find('fluentLoader').length > 0)) {
                fluentLoaderUrl = data.fluentLoader;
                fluentLoaderPage++;
                setTimeout(fluentLoader, fluentLoaderTimeout);

            }
            $(container).append(newContents);
            prepareElements(newContents);
        } else {
            $(container).html(data);
            prepareElements(container);
        }
    });
}

var prepareElements = function (element) {
    element.find('.filters input[type=text]').keyup(function () {
        $('.filters button[type=submit]').addClass('button-primary');
    });

    element.find('.filters input[type=text], .filters input[type=checkbox]').each(function () {
        var input = $(this);
        if ((input.attr('type') === 'text') && (input.val() !== undefined) && (input.val() !== '') || (input.is(':checked') === true)) {
            $('.filters').addClass('active');
        }
    });

    element.find('.filters .material-icons').click(function () {
        var right = $('.filters .material-icons.right').hasClass('active');
        if (right) {
            $('.filters .material-icons.right').removeClass('active');
            $('.filters .material-icons.down').addClass('active');
            $('.filters .body, .filters .footer').css('display', 'block');
        } else {
            $('.filters .material-icons.right').addClass('active');
            $('.filters .material-icons.down').removeClass('active');
            $('.filters .body, .filters .footer').css('display', 'none');
        }
    });
    element.find('.filters-toggle').click(function () {
        if ($('.filters').hasClass('active')) {
            $('.filters').removeClass('active');
        } else {
            $('.filters').addClass('active');
        }
    });

    element.find('.more-icon').click(function () {
        var moreIcon = $(this);
        moreIcon.html('<i class="material-icons rotate">refresh</i>');
        $.ajax({
            url: '/api/document/detail/' + moreIcon.parents('.table-row').data('id'),
        }).done(function (data) {
            moreIcon.parents('.table-row').eq(0).find('.more').html(data);
            moreIcon.parents('.table-row').eq(0).find('.more').css('display', 'block');
            moreIcon.remove();
        });
    });

    element.find('.image img').click(function () {
        var image = $(this).data('img');
        if ((image != '') && (image != undefined)) {
            $('#imageDialog').find('img').attr('src', image);
            $('#imageDialog').addClass('visible');
        }
    });

    element.find('a').click(function () {
        if ($(this).attr('target') == undefined) {
            loadContent($('#wrapper'), $(this).attr('href'));
            return false;
        } else if ($(this).attr('target') == '') {
            window.location.href = $(this).attr('href');
            return false;
        }
        return true;
    });

    var tableRows = element.find('.table-row.select');
    tableRows.each(function () {
        var row = $(this);
        if ((row.find('input[type=checkbox]').length==0) && (row.data('id') !== undefined) && (row.data('id') !== '')) {
            row.css('padding-left', '20px');
            var checkobox = $('<input type="checkbox"/>');
            checkobox.data('id', row.data('id'));
            checkobox.addClass('checkbox');
            checkobox.click(function () {
                collection = [];
                tableRows.find('.checkbox:checked').each(function () {
                    collection.push($(this).data('id'));
                });
                if (collection.length > 0) {
                    $('.box.mass').css('display', 'block');
                } else {
                    $('.box.mass').css('display', 'none');
                }
            })
            row.prepend(checkobox);
        }
    });

    element.find('form.mass').submit(function () {
        $(this).find('#id').remove();
        var id = $('<div id="id"></div>');
        console.log(collection);
        $(collection).each(function () {
            id.append($('<input type="hidden" name="id[]" value="' + this + '"/>'));
        });
        $(this).append(id);
    });

    element.find('.datepicker').datepicker({dateFormat: 'dd-mm-yy'});

    if ($(document.body).height() < $(window).height()) {
        $('footer').css('position', 'fixed');
    } else {
        $('footer').css('position', 'relative');
    }

    element.find('fluentLoader').each(function () {
        fluentLoaderUrl = false;
        fluentLoaderPage = 2;
        fluentLoaderWork = false;
        var url = window.location.href.toString();
        fluentLoaderUrl = url.replace('http://' + window.location.host + '/', '');
        setTimeout(fluentLoader, fluentLoaderTimeout);
    });
}

$(document).ready(function () {
    prepareElements($('body'));

    $('#loading').css('display', 'none');

    $(window).bind('popstate', function (event) {
        loadContent($('#wrapper'), event.originalEvent.state.url, true);
    });

    modal($('#imageDialog'));

    $('.menu-toggle').click(function () {
        if ($('#menu').hasClass('visible')) {
            $('#menu').removeClass('visible');
        } else {
            $('#menu').addClass('visible');
        }
    });
    $('#menu a').click(function () {
        $('#menu').removeClass('visible');
    });
});