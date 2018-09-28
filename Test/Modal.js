var zIndex = 1000;
Modal = function (html, params) {
    var modal = $('<div class="window"><div id="modalBg">' +
        '</div>' +
        '<div id="modal">' +
        '    <div class="header"><h3>'+params.title+'</h3><i class="material-icons close">close</i></div>' +
        '    <div class="content"></div>' +
        '    <div class="footer"><buttton class="btn close">Zamknij</buttton>' +
        '    <buttton class="btn save">Zapisz</buttton></div>' +
        '</div></div>');
    modal.data('hWnd', modal);
    modal.find('#modalBg, #modal').css('z-index', zIndex++);
    if (params.success) {
        modal.find('#modal .save').css('display', 'block');
        modal.find('#modal .save').unbind().click(function () {
            params.success(modal);
        });
    } else {
        modal.find('#modal .save').css('display', 'none');
    }
    if (params.close) {
        modal.find('#modal .close').css('display', 'block');
        modal.find('#modal .close').unbind().click(function () {
            params.close(modal);
        });
    } else {
        modal.find('#modal .close').css('display', 'none');
    }
    modal.close = function(){
        modal.remove();
    }
    var htmlContent = '';
    try{
        htmlContent = $(html);
    }catch (e) {
        htmlContent = html;
    }
    modal.find('#modal .content').html(htmlContent);
    $(document.body).append(modal);
}