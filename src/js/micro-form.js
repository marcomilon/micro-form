$(document).ready(function() {
    $('.toolbar--add__add').click(function(e)  {
        e.preventDefault();
        var el = $(this).parent().next();
        $(this).parent().next().children().last().clone().appendTo(el);
        var count = $(this).parent().next().children().length;
        if(count > 1) {
            $(this).parent().next().children().last().find('.toolbar--delete').css('display', 'block');
        }
    });
    
    $('.toolbar--add__block').click(function(e)  {
        e.preventDefault();
        var el = $(this).parent().next();
        $(this).parent().next().children().last().clone().appendTo(el);
        $(this).parent().next().children().last().find(':input').each(function(index) {
            $(this).val('');
            var name = $(this).attr('name');
            var index = name.match(/[0-9]+/);
            var tokens = name.split(/[0-9]+/);
            var newIndex = parseInt(index) + 1;
            var newName = tokens[0] + newIndex + tokens[1];
            $(this).attr('name', newName);
        });
        var count = $(this).parent().next().children().length;
        if(count > 1) {
            $(this).parent().next().children().last().find('.toolbar--delete').css('display', 'block');
        }
    });
    
    $(document).on('click', '.toolbar--delete__delete', function(e) {
        e.preventDefault();
        $(this).parent().parent().remove();
    })
});