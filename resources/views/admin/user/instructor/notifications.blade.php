 @extends('admin.layouts.master')
 @section('admin_content')
     <div class="container-fluid">
         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <div class="card-header">
                         <div class="row">
                             <div class="col-lg-4 col-6 d-flex align-items-center">
                                 <h2 class="card-title text-capitalize">@lang('backend.notifications.header')</h2>
                             </div>
                         </div>
                     </div>
                     <div class="card-body notification-card">
                         <div class="row my-3">
                             @foreach ($notifications as $notification)
                                 @php
                                     $url = 'javascript:;';
                                     if (in_array($notification->identifier, ['student_purchase_course', 'student_purchase_bundle'])) {
                                         $url = route('instructor.sales_report');
                                     } elseif (in_array($notification->identifier, ['admin_marks_course_as_pending', 'admin_marks_course_as_active'])) {
                                         $url = route('instructor.courses');
                                     } elseif (in_array($notification->identifier, ['admin_course_review_submit'])) {
                                         $url = route('instructor.courses.review', $notification->params['id']);
                                     } elseif (in_array($notification->identifier, ['payout_request_approve'])) {
                                         $url = route('instructor.payout_report');
                                     }
                                 @endphp
                                 <div class="col-12 mb-3">
                                     <a href="{{ $url }}">
                                         <div class="d-flex notify-details">
                                             <span class="mx-2 mx-sm-3"> <i class="fas fa-bell bell-icon"></i></span>
                                             <div class="flex-column">
                                                 <h5>{{ __('notifications.' . $notification->identifier . '_title') }}</h5>
                                                 <p class="mb-0">
                                                     {{ __('notifications.' . $notification->identifier . '_description', [
                                                         'course_name' => $notification->params['name'] ?? '',
                                                         'bundle_name' => $notification->params['name'] ?? '',
                                                         'student_name' => $notification->params['student'] ?? '',
                                                         'amount' => !empty($notification->params['amount']) ? formatPrice($notification->params['amount']) : '',
                                                     ]) }}
                                                 </p>
                                                 <p>{{ formatDate($notification->created_at, 'd M, Y h:i A') }}</p>
                                             </div>
                                         </div>
                                     </a>
                                 </div>
                             @endforeach
                         </div>
                         {!! $notifications->links('pagination.html') !!}
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
