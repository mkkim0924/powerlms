$(document).ready(function () {
    'use strict';
    $('.form_time').timepicker({
        format: 'hh:mm:ss',
        showSeconds: true,
        showMeridian: false,
        minuteStep: 15,
        secondStep: 30
    });

    $(document).on('change', "#course_id", function () {
        $(".sectionInput").val("").trigger('change');
    })

    /* SET SLUG CONDITIONS */
    if (!is_edit) {
        $("#quiz_name").focusout(function (i, d) {
            var title = $.trim($("#quiz_name").val());
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

    $(".sectionInput").select2({
        placeholder: $plugin_translations.select2_placeholder,
        ajax: {
            url: getSectionByCourseURL,
            type: "get",
            dataType: 'json',
            data: function (params) {
                var searchTerm = params.term;
                return {
                    searchTerm: searchTerm,
                    courseId: $("#course_id").val()
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });
});
