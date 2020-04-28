$(document).ready(function() {
    $(".alert-autoclose").fadeTo(5000, 500).slideUp(500, function() {
        $(".alert-autoclose").slideUp(500);
    });
});


