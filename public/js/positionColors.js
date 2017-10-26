$(document).ready(function() {
    $('.position-outcome').each(function() {
        var val = parseFloat($(this).text());
        if(val < 0) {
            $(this).parent().css({'color': '#e74c3c'});
        }
        else if (val === 0) {
            $(this).parent().css({'color': '#3498db'});
        }
        else {
            $(this).parent().css({'color': '#27ae60'});
        }
    });
});