var $document = $(document);
$document.ready(function () {
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
            var isFormValid = $("#unitForm").isValid();
            return isFormValid;
        }
    });

    $document.on('click', "a[href='#finish']", function () {
        $("#unitForm").submit();
    });

    /* SET SLUG CONDITIONS */
    if (!is_edit) {
        $("#unit_name").focusout(function (i, d) {
            var title = $.trim($("#unit_name").val());
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

    $document.on('change', '#course_id', function (){
        $("#section_id").val("").trigger('change');
    })

    $(".sectionInput").select2({
        placeholder: $plugin_translations.select2_placeholder,
        "language": {
            "noResults": function () {
                return $plugin_translations.select2_empty_records;
            }
        },
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

    $document.on('change', '#lesson_type', function (){
        $("#lessonTypeContentDiv").html("");
        var lessonTypeVal = $(this).val();
        var cloneInput = "";
        if((lessonTypeVal=="youtube") || (lessonTypeVal=="vimeo") || (lessonTypeVal=="video_url")){
            cloneInput = $("#videoUrlWithThumbnailImg").last().clone();
            cloneInput.find('.dropifyInput').dropify();
            cloneInput.find('.form_time').timepicker({
                format: 'hh:mm:ss',
                showSeconds: true,
                showMeridian: false,
                minuteStep: 1,
                secondStep: 1
            });
        }else if(lessonTypeVal=="video_file"){
            cloneInput = $("#videoUploadWithThumbnailImg").last().clone();
            cloneInput.find('.dropifyInput').dropify();
            cloneInput.find('.form_time').timepicker({
                format: 'hh:mm:ss',
                showSeconds: true,
                showMeridian: false,
                minuteStep: 1,
                secondStep: 1
            });
        }else if(lessonTypeVal=="document"){
            cloneInput = $("#documentTypes").last().clone();
            cloneInput.find('.dropifyInput').dropify();
            cloneInput.find('#lesson_document_type').select2({
                placeholder: $plugin_translations.select2_placeholder,
                minimumResultsForSearch: Infinity,
                "language": {
                    "noResults": function () {
                        return $plugin_translations.select2_empty_records;
                    }
                },
            });
        }
        if (cloneInput != ""){
            $("#lessonTypeContentDiv").html(cloneInput.show());
        }
    })

    if ($('.edit_form_time').length > 0){
        $('.edit_form_time').timepicker({
            format: 'hh:mm:ss',
            showSeconds: true,
            showMeridian: false,
            minuteStep: 1,
            secondStep: 1
        });
    }

    $document.on('click', "#addNewFaqRow", function () {
        var newRowCloned = $('.faqCloneTemplate').last().clone();
        newRowCloned.show();
        newRowCloned.find('.editor').summernote({
            tabsize: 4,
            height: 250
        });
        $("#unitFaqs").prepend(newRowCloned);
    });

    $document.on('click', ".removeFaqRow", function () {
        var self = $(this);
        self.parents(".faqCloneTemplate").remove();
    });

    /*Attachment tab*/
    $(document).on('click', "#addNewAttachment", function () {
        var html = $(".attachmentDiv").last().clone();
        html.show();
        html.find(".attachment-dropify").dropify();
        $("#attachmentRows").append(html);
    });

    $('.attachmentInput').dropify()

    $(document).on('click', ".removeAttachment", function () {
        $(this).parents(".attachmentDiv").remove();
    });

    $(document).on('click', ".deleteExistAttachment", function () {
        var self = $(this);
        var attachmentId = self.data('id');
        bootbox.confirm({
            message: $plugin_translations.delete_confirmation_title,
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
                    $.ajax({
                        type: "post",
                        dataType: "json",
                        url: $app_url + '/instructor/chapters/remove-attachment',
                        data: {id: attachmentId},
                        success: function (data) {
                            self.parents(".attachmentDiv").remove();
                        },
                    })
                }
            }
        });
    });
});
