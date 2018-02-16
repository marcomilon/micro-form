$(document).ready(function() {
    $('.toolbar--add__add').click(function(e)  {
        e.preventDefault();
        $(this).parent().next().children().last().clone().appendTo(".repeater");
    });
    
    $('.toolbar--add__block').click(function(e)  {
        e.preventDefault();
        $(this).parent().next().children().last().clone().appendTo(".repeater");
        $(this).parent().next().children().last().find(':input').each(function(index) {
            $(this).val('');
            var name = $(this).attr('name');
            var index = name.match(/[0-9]+/);
            var tokens = name.split(/[0-9]+/);
            var newIndex = parseInt(index) + 1;
            var newName = tokens[0] + newIndex + tokens[1];
            $(this).attr('name', newName);
        });
    });
    
    $(document).on('click', '.toolbar--delete__delete', function(e) {
        e.preventDefault();
        $(this).parent().parent().remove();
    })
});