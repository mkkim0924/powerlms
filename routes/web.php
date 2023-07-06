<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BundleController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\InstructorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('lang/{lang}', [LanguageController::class, 'swap'])->name('language.swap');
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('about', [HomeController::class, 'aboutPage'])->name('about');
Route::get('contact', [ContactController::class, 'contact'])->name('contact');

Route::get('layout/{num}', [HomeController::class, 'layoutPreview'])->name('layout_preview');

Route::get('categories', [CategoriesController::class, 'getAllCategories'])->name('categories');
Route::get('category/{slug}', [CategoriesController::class, 'getCategoryDetails'])->name('category_detail');

Route::get('courses', [CourseController::class, 'getAllCourses'])->name('courses');
Route::get('course/{slug}', [CourseController::class, 'getCourseDetails'])->name('course_detail');
Route::get('course/{slug}/reviews', [CourseController::class, 'getCourseReviews'])->name('course_reviews');

Route::get('webinar/{slug}', [CourseController::class, 'getWebinarDetails'])->name('webinar_detail');

Route::get('blogs', [BlogController::class, 'getAllBlogs'])->name('blogs');
Route::get('blog/{slug}', [BlogController::class, 'getBlogDetails'])->name('blog_detail');
Route::get('blog-category/{slug}', [BlogController::class, 'getBlogCategoryDetails'])->name('blog_category_detail');

Route::get('bundles', [BundleController::class, 'index'])->name('bundles');
Route::get('bundle/{slug}', [BundleController::class, 'detail'])->name('bundle_detail');

Route::get('page/{slug}', [PageController::class, 'pages'])->name('details');

Route::post('auth-login', [LoginController::class, 'loginRedirection'])->name('powerlms.auth');

Auth::routes();

Route::controller(ForgotPasswordController::class)->group(function () {
    Route::post('reset-password/send-link', 'submitForgetPasswordForm')->name('reset-password.send-link');
    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset-password.link');
    Route::post('reset-password/store', 'submitResetPasswordForm')->name('reset-password.store');
});

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login/authenticate', [LoginController::class, 'authenticateUser'])->middleware(['throttle:4,1,checklimit'])->name('user.authenticate');
Route::post('register', [LoginController::class, 'storeUser'])->name('register');
Route::get('activate-user/{token}', [LoginController::class, 'activateUser'])->name('user.activation-process');

Route::get('auth/{provider}', [LoginController::class, 'redirectToSocialProvider'])->name('auth.social');
Route::get('auth/{provider}/callback', [LoginController::class, 'handleSocialProviderCallback'])->name('auth.social.callback');

Route::get('become-an-instructor', [UserController::class, 'becomeInstructor'])->name('becomeAInstructor');

Route::get('instructors', [InstructorController::class, 'getInstructorList'])->name('instructor.list');
Route::get('instructor/{id}', [InstructorController::class, 'getInstructorDetails'])->name('instructor.details');

Route::middleware(['auth', 'userAccess'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout']);

    Route::get('/instructor-application', [DashboardController::class, 'instructorApplicationPage'])->name('instructor.become');
    Route::post('/application/store', [DashboardController::class, 'storeInstructorApplication'])->name('application.store');

    // Profile
    Route::get('profile', [UserController::class, 'index'])->name('profile');
    Route::post('profile/update', [UserController::class, 'update'])->name('profile.update');
    Route::post('profile/update-image', [UserController::class, 'updateImage'])->name('profile.update_image');
    Route::post('password/update', [UserController::class, 'password'])->name('password.update');

    Route::get('my-courses', [UserController::class, 'getUserEnrollCourses'])->name('my-courses');
    Route::get('my-webinars', [UserController::class, 'getUserEnrollWebinars'])->name('my-webinars');
    Route::post('get-user-review-html', [UserController::class, 'getUserReviewHtml'])->name('get-user-review-html');
    Route::post('submit-user-course-review', [UserController::class, 'submitCourseReview'])->name('submit-user-course-review');

    Route::post('/course-status', [CourseController::class, 'courseStatus'])->name('course_status');
    Route::post('/webinar-enroll', [CourseController::class, 'enrollWebinar'])->name('enroll_webinar');
    Route::get('webinar-live-stream/{slug}', [CourseController::class, 'getWebinarLiveStreamDetails'])->name('webinar_live_stream');

    Route::post('/live-lesson-slot-attend', [CourseController::class, 'attendLiveLessonSlot'])->name('attendLiveLessonSlot');

    Route::post('/mark-unit-complete', [CourseController::class, 'markUnitCompleted'])->name('mark_unit_complete');
    Route::get('course-complete/{slug}', [CourseController::class, 'completeCourse'])->name('course_complete');
    Route::post('/quiz-submit', [CourseController::class, 'submitQuiz'])->name('submit_quiz');
    Route::get('/quiz/{course_slug}/{quiz_slug}', [CourseController::class, 'getQuizDetails'])->name('quiz_details');
    Route::get('/quiz-result/{course_slug}/{quiz_slug}', [CourseController::class, 'quizResult'])->name('quiz_result');

    Route::post('course-survey/results/store', [CourseController::class, 'storeSurveyResults'])->name('course_survey.results.store');
    Route::get('course-survey/skipped/{survey_id}', [CourseController::class, 'updateSurveySkipped'])->name('course_survey.skipped');

    Route::get('download-certificate/{slug}', [CertificateController::class, 'downloadCertificate'])->name('certificate.download');

    Route::get('/payment/course/{slug}', [PaymentController::class, 'index'])->name('payment.course');
    Route::get('/payment/bundle/{slug}', [PaymentController::class, 'bundlePayment'])->name('payment.bundle');
    Route::post('stripe-payment/create', [PaymentController::class, 'stripePayment'])->name('payment.stripe.create');

    Route::post('offline-payment/create', [PaymentController::class, 'storeOfflinePayment'])->name('offline_payment.store');

    Route::post('razorpay-payment', [PaymentController::class, 'razorpayPayment'])->name('payment.razorpay');
    Route::post('razorpay-payment/create', [PaymentController::class, 'createRazorpayPayment'])->name('payment.razorpay.create');

    Route::post('paypal-payment', [PaymentController::class, 'paypalRedirection'])->name('payment.paypal.redirection');
    Route::get('paypal-payment/success', [PaymentController::class, 'paypalSuccess'])->name('payment.paypal.success');
    Route::get('paypal-payment/cancel', [PaymentController::class, 'paypalCancel'])->name('payment.paypal.cancel');

    Route::post('payu-payment', [PaymentController::class, 'payuPayment'])->name('payment.payu_redirection');
    Route::post('payu-payment/status', [PaymentController::class, 'getPayUStatus'])->name('payment.payu_status');

    Route::post('payumoney-payment', [PaymentController::class, 'payumoneyRedirection'])->name('payment.payumoney.redirection');

    Route::get('payment/thank-you/{type}/{slug}', [PaymentController::class, 'thankYouPage'])->name('payment.thank_you');

    Route::get('purchase-history', [PaymentController::class, 'userPurchaseHistory'])->name('purchase');
    Route::get('purchase/invoice/{id}', [PaymentController::class, 'invoice'])->name('purchase.invoice');

    Route::get('subscription-payment/success', [SubscriptionController::class, 'successPayment'])->name('subscription_payment.success');
    Route::get('subscription-payment/cancel', [SubscriptionController::class, 'cancelPayment'])->name('subscription_payment.cancel');
    Route::get('subscription-payment/{slug}', [SubscriptionController::class, 'createStripeSession'])->name('subscription_payment.course');

    Route::get('chat', [ChatController::class, 'index'])->name('chat');
    Route::post('chat/send-message', [ChatController::class, 'sendMessage'])->name('chat.sendMessage');
    Route::post('chat/check-new-message', [ChatController::class, 'checkNewMessage'])->name('chat.checkNewMessage');

    Route::get('download-attachment/{id}', [CourseController::class, 'downloadAttachment'])->name('downloadAttachment');
});
Route::post('webhook-stripe', [SubscriptionController::class, 'webhook'])->name('webhook-stripe');
Route::get('search', [HomeController::class, 'search'])->name('search');


Route::get('{course_slug}/{unit_slug}', [CourseController::class, 'curriculumDetails'])->name('curriculum_detail')->middleware('userAccess');
