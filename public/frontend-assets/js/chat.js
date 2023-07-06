$(document).ready(function () {
    "use strict";

    reloadTime();
    scrollToLatestMsg();
    setInterval("reloadNewMessages();", 10000);

    $(document).on('click', "#submitButton", function () {
        var message = $("#message").val();
        if ($.trim(message) == '') {
            $("#message").focus();
            return false;
        }
        var dataValue = {
            'thread_id': $("#thread_id").val(),
            'message': $("#message").val()
        };
        $("#submitButton").prop("disabled", true);
        $("#message").prop("disabled", true);
        $.ajax({
            url: $app_url + "/chat/send-message",
            type: 'POST',
            data: dataValue,
            dataType: "json",
            success: function (data) {
                $('#message').val(null);
                $("#chatContainer").append(data.html);
                $('#last_message_id').val(data.last_message_id);
                reloadTime();
                scrollToLatestMsg();
            },
            error: function () {
                // alert('error');
            },
            complete: function () {
                $("#message").prop("disabled", false);
                $("#submitButton").prop("disabled", false);
            }
        });
    });
})

function scrollToLatestMsg() {
    if ($('.chat-history').length) {
        $('.chat-history').scrollTop($('.chat-history')[0].scrollHeight);
    }
}

function reloadTime() {
    $(".timeago").each(function () {
        $(this).html(jQuery.timeago($(this).attr('datetime')));
    })
}

function reloadNewMessages() {
    var thread_id = $("#thread_id").val();
    var last_message_id = $('#last_message_id').val();
    if ((last_message_id != "") && (thread_id != "")) {
        $.ajax({
            url: $app_url + "/chat/check-new-message",
            type: 'post',
            data: {"thread_id": thread_id, "last_message_id": last_message_id},
            datatype: 'json',
            success: function (data) {
                if (data.last_message_id != null) {
                    $("#chatContainer").append(data.html);
                    $('#last_message_id').val(data.last_message_id);
                    scrollToLatestMsg();
                    reloadTime();
                }
            },
            error: function () {
                // alert('error');
            }
        });
    }
}
