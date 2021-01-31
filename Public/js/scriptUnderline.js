$(document).ready(function(){
    $("input").on({
        mouseenter: function(){
            $(this).css("text-decoration", "underline");
        },
        mouseleave: function(){
            $(this).css("text-decoration", "none");
        }
    });
});