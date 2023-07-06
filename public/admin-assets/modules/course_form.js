$(document).ready(function () {
    'use strict';
    $('#wizard2').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        autoFocus: true,
        showFinishButtonAlways: is_edit,
        enableAllSteps: is_edit,
        titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
        onStepChanging: function (event, currentIndex, newIndex) {
            if (newIndex < currentIndex) {
                return true;
            }
            var isFormValid = $("#courseForm").isValid();
            return isFormValid;
        }
    });

    $(document).on('click', "#calculateEarning", function () {
        var isFormValid = $("#courseForm").isValid();
        if (isFormValid) {
            var price = 0;
            if ($("#discount_flag").prop('checked')) {
                price = $("#discounted_price").val();
            } else {
                price = $("#price").val();
            }
            $.ajax({
                type: "POST",
                dataType: "json",
                url: $app_url + '/instructor/course/price-calculation',
                data: { price: price },
                beforeSend: function () {
                    $('#priceCalculationDiv').html("");
                    $('.preloader').fadeIn();
                },
                success: function (data) {
                    $('#priceCalculationDiv').html(data.html);
                    $('.preloader').fadeOut();
                }
            });
        }
    });

    $(document).on('click', "a[href='#finish']", function () {
        $("#courseForm").submit();
    });

    /* SET SLUG CONDITIONS */
    if (!is_edit) {
        $("#course_name").focusout(function (i, d) {
            var title = $.trim($("#course_name").val());
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

    $("#editSlugInput").focusout(function (e) {
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

    $(document).on('change', '#is_free', function () {
        $("#coursePriceDiv").toggle(!$(this).is(':checked'));
    })
    $(document).on('change', '#discount_flag', function () {
        $("#discountedPriceInput").toggle($(this).is(':checked'));
    })
    $(document).on('change', '#subscription_flag', function () {
        $("#subscriptionInputs").toggle($(this).is(':checked'));
    })

    $(document).on('click', '.addNewPoint', function () {
        var newRowCloned = $('.cloneInputDiv').last().clone();
        newRowCloned.find('.cloneInput').attr('name', $(this).data('name') + '[]');
        newRowCloned.show();
        console.log(newRowCloned);
        console.log($(this).data('name'), $(this).data('div'));
        $("#" + $(this).data('div')).append(newRowCloned);
    })

    $(document).on('click', ".removePoint", function () {
        $(this).parents(".input-group").remove();
    });

    $(document).on('change', "#intro_video_provider", function () {
        if ($(this).val() == 'video_file') {
            $('#intro_video_url_div').hide();
            $('#intro_video_url').val('');
            $('#video_file_div').show();
        } else {
            $('#intro_video_url_div').show();
            $('#video_file_div').hide();
            $('#video_file').val('');
        }
    });
});
