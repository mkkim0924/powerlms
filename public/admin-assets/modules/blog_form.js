$(document).ready(function () {
    'use strict';

    /* SET SLUG CONDITIONS */
    if (!is_edit) {
        $("#blog_name").focusout(function (i, d) {
            var title = $.trim($("#blog_name").val());
            if (title.length > 0) {
                title = title.toLowerCase();
                title = title.replace(/[^a-z0-9\s]/gi, "").replace(/  +/g, " ").replace(/[_\s]/g, "-");
            }
            $("#slug").val(title);
        });
    }
    $("#slug").focusout(function (e) {
        var slug = $.trim($(this).val().toLowerCase());
        $(this).val(slug);
    });

    $(".slugInput").keypress(function (e) {
        var regex = new RegExp("^[A-Za-z0-9-]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });
});

