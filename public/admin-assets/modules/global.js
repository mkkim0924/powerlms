$(document).ready(function () {
    "use strict";

    // Apply the wysiwyg editor to the elements with "wysiwyg_editor" class
    if ($('.html_editor').length > 0) {
        $('.html_editor').summernote({
            tabsize: 4,
            height: 250,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
        });
    }

    if ($('.js-input-switch').length > 0) {
        let elems = Array.prototype.slice.call($('.js-input-switch'));
        elems.forEach(function (html) {
            new Switchery(html, {
                size: 'small'
            });
        });
    }

    if ($(".dropify").length > 0) {
        var dropifyInput = $(".dropify").dropify({
            messages: {
                default: $plugin_translations.dropify_default,
                replace: $plugin_translations.dropify_replace,
                remove: $plugin_translations.dropify_remove,
                error: $plugin_translations.dropify_error
            }
        });
    }

    if ($(".select2Search").length > 0) {
        $('.select2Search').select2({
            placeholder: $plugin_translations.select2_placeholder,
            allowClear: true,
            "language": {
                "noResults": function () {
                    return $plugin_translations.select2_empty_records;
                }
            },
        });
    }

    if ($(".select2SearchWithoutClear").length > 0) {
        $('.select2SearchWithoutClear').select2({
            placeholder: $plugin_translations.select2_placeholder,
            "language": {
                "noResults": function () {
                    return $plugin_translations.select2_empty_records;
                }
            }
        });
    }

    $("form").on('submit', function () {
        if ($('.note-editor').length > 0) {
            $('.note-editor').each(function () {
                if ($(this).hasClass('codeview')) {
                    $(this).find('.btn-codeview').trigger('click');
                }
            })
        }
    });

    if ($(".select2_no_search").length > 0) {
        $('.select2_no_search').select2({
            placeholder: $plugin_translations.select2_placeholder,
            minimumResultsForSearch: Infinity,
            "language": {
                "noResults": function () {
                    return $plugin_translations.select2_empty_records;
                }
            }
        });
    }

    $(document).on('click', '.message-item', function () {
        $(this).removeClass('bg-lightgrey');
        $.ajax({
            type: "get",
            dataType: "json",
            url: $app_url + '/instructor/notification/read/' + $(this).data('id'),
            success: function (data) {
                if (data.redirect_url) {
                    window.location = data.redirect_url;
                }
            },
        })
    });
});

function confirmDelete(delete_url, msg = $plugin_translations.delete_confirmation_title) {
    bootbox.confirm({
        message: msg,
        buttons: {
            confirm: {
                label: $plugin_translations.delete_confirmation_yes_btn,
                className: 'btn-success mx-2'
            },
            cancel: {
                label: $plugin_translations.delete_confirmation_no_btn,
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result === true) {
                window.location = delete_url;
            }
        }
    });
}
