var modal = function(container){
    container = $(container);
    container.click(function(){
        container.removeClass('visible');
    });
    container.find('.container').click(function(e){
        e.preventDefault();
        return false;
    });
}