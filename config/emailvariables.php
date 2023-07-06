<?php

return [
    'activation_link' => [
        'NAME' => 'name_of_the_user',
        'URL' => 'activation_url_link',
        'DATE_TIME' => "date_and_time_of_request",
    ],
    'reset_password' => [
        'NAME' => 'name_of_the_user',
        'URL' => 'reset_password_link_url',
        'DATE_TIME' => "date_and_time_of_request",
    ],
    'admin_set_password_mail' => [
        'NAME' => 'name_of_the_user',
        'URL' => 'set_password_link_url',
    ],
    'instructor_application_approve' => [
        'NAME' => 'name_of_the_user',
        'URL' => 'login_url',
    ],
    'instructor_application_reject' => [
        'NAME' => 'name_of_the_user',
        'REASON' => 'reject_reason',
        'URL' => 'login_url',
    ],
    'admin_create_instructor_application' => [
        'NAME' => 'name_of_the_user',
        'EMAIL'=> 'login_instructor_email_details',
        'PASSWORD' => 'login_instructor_password_details',
    ],
    'live_lesson_slot_details_mail' => [
        'NAME' => 'name_of_the_user',
        'TITLE'=> 'zoom_slot_title',
        'START_AT'=> 'zoom_meeting_start_date',
        'DURATION'=> 'zoom_meeting_duration',
        'MEETING_ID'=> 'zoom_meeting_id',
        'PASSWORD'=> 'zoom_meeting_password',
        'JOIN_URL'=> 'zoom_meeting_join_url',
    ],
    'live_lesson_slot_reminder_mail' => [
        'NAME' => 'name_of_the_user',
        'TITLE'=> 'zoom_slot_title',
        'START_AT'=> 'zoom_meeting_start_date',
        'DURATION'=> 'zoom_meeting_duration',
        'MEETING_ID'=> 'zoom_meeting_id',
        'PASSWORD'=> 'zoom_meeting_password',
        'JOIN_URL'=> 'zoom_meeting_join_url',
    ],
    'live_lesson_slot_update_mail' => [
        'NAME' => 'name_of_the_user',
        'TITLE'=> 'zoom_slot_title',
        'START_AT'=> 'zoom_meeting_start_date',
        'DURATION'=> 'zoom_meeting_duration',
        'MEETING_ID'=> 'zoom_meeting_id',
        'PASSWORD'=> 'zoom_meeting_password',
        'JOIN_URL'=> 'zoom_meeting_join_url',
    ],
    'live_lesson_slot_delete_mail' => [
        'NAME' => 'name_of_the_user',
        'TITLE'=> 'zoom_slot_title',
        'START_AT'=> 'zoom_meeting_start_date',
        'DURATION'=> 'zoom_meeting_duration',
    ],
    'offline_payment_request_reject_mail' => [
        'NAME' => 'name_of_the_user',
        'TITLE'=> 'course_or_bundle_title',
        'AMOUNT'=> 'course_or_bundle_amount',
    ],
    'offline_payment_request_approve_mail' => [
        'NAME' => 'name_of_the_user',
        'TITLE'=> 'course_or_bundle_title',
        'AMOUNT'=> 'course_or_bundle_amount',
    ],
    'payment_success_mail' => [
        'NAME' => 'name_of_the_user',
        'TITLE'=> 'course_or_bundle_title',
        'AMOUNT'=> 'course_or_bundle_amount',
        'DATE_TIME' => "date_and_time_of_request",
    ],
];
