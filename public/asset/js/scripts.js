$(document).ready(function(){
    $("[rel=tooltip]").tooltip({ placement: 'top'});
});

$(document).ready(function() {
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 4000);
});    