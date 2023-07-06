<?php

namespace App\Providers;

use App\Events\LiveLessonSlotDeleteMailEvent;
use App\Events\LiveLessonSlotDetailsMailEvent;
use App\Events\LiveLessonSlotReminderMailEvent;
use App\Events\LiveLessonSlotUpdateMailEvent;
use App\Events\OfflinePaymentRequestApproveMailEvent;
use App\Events\OfflinePaymentRequestRejectMailEvent;
use App\Events\PaymentSuccessEmailEvent;
use App\Events\UserRegistrationEvent;
use App\Listeners\LiveLessonSlotDeleteMailEventListener;
use App\Listeners\LiveLessonSlotDetailsMailEventListener;
use App\Listeners\LiveLessonSlotReminderMailEventListener;
use App\Listeners\LiveLessonSlotUpdateMailEventListener;
use App\Listeners\OfflinePaymentRequestApproveMailEventListener;
use App\Listeners\OfflinePaymentRequestRejectMailEventListener;
use App\Listeners\PaymentSuccessEmailEventHandler;
use App\Listeners\SendResetPasswordEventHandler;
use App\Events\AdminSetPasswordEvent;
use App\Events\InstructorApplicationApproveEvent;
use App\Events\InstructorApplicationRejectEvent;
use App\Events\InstructorCreateMailEvent;
use App\Events\SendResetPasswordMailEvent;
use App\Listeners\AdminSetPasswordEventListener;
use App\Listeners\InstructorAccountCreateEventListener;
use App\Listeners\InstructorApplicationApproveEventListener;
use App\Listeners\InstructorApplicationRejectEventListener;
use App\Listeners\UserRegistrationEventHandler;
use App\Models\BundleUser;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\InstructorPayoutLog;
use App\Models\LiveLessonSlot;
use App\Models\LiveLessonSlotUser;
use App\Models\Notification;
use App\Models\PaymentTransaction;
use App\Models\Quiz;
use App\Models\Review;
use App\Models\Sections;
use App\Models\Units;
use App\Models\WebinarUser;
use App\Observers\BundleUserObserver;
use App\Observers\CourseObserver;
use App\Observers\CourseUserObserver;
use App\Observers\ForumCategoryObserver;
use App\Observers\InstructorPayoutObserver;
use App\Observers\LiveLessonSlotObserver;
use App\Observers\LiveLessonSlotUserObserver;
use App\Observers\NotificationObserver;
use App\Observers\PaymentTransactionObserver;
use App\Observers\QuizObserver;
use App\Observers\ReviewObserver;
use App\Observers\SectionObserver;
use App\Observers\UnitObserver;
use App\Observers\WebinarUserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use TeamTeaTime\Forum\Models\Category;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AdminSetPasswordEvent::class => [
            AdminSetPasswordEventListener::class,
        ],
        SendResetPasswordMailEvent::class => [
            SendResetPasswordEventHandler::class,
        ],
        UserRegistrationEvent::class => [
            UserRegistrationEventHandler::class,
        ],
        InstructorApplicationApproveEvent::class => [
            InstructorApplicationApproveEventListener::class
        ],
        InstructorApplicationRejectEvent::class => [
            InstructorApplicationRejectEventListener::class
        ],
        InstructorCreateMailEvent::class => [
            InstructorAccountCreateEventListener::class
        ],
        LiveLessonSlotUpdateMailEvent::class => [
            LiveLessonSlotUpdateMailEventListener::class
        ],
        LiveLessonSlotDeleteMailEvent::class => [
            LiveLessonSlotDeleteMailEventListener::class
        ],
        LiveLessonSlotReminderMailEvent::class => [
            LiveLessonSlotReminderMailEventListener::class
        ],
        LiveLessonSlotDetailsMailEvent::class => [
            LiveLessonSlotDetailsMailEventListener::class
        ],
        OfflinePaymentRequestApproveMailEvent::class => [
            OfflinePaymentRequestApproveMailEventListener::class
        ],
        OfflinePaymentRequestRejectMailEvent::class => [
            OfflinePaymentRequestRejectMailEventListener::class
        ],
        PaymentSuccessEmailEvent::class => [
            PaymentSuccessEmailEventHandler::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Course::observe(CourseObserver::class);
        Sections::observe(SectionObserver::class);
        Units::observe(UnitObserver::class);
        Quiz::observe(QuizObserver::class);
        CourseUser::observe(CourseUserObserver::class);
        PaymentTransaction::observe(PaymentTransactionObserver::class);
        InstructorPayoutLog::observe(InstructorPayoutObserver::class);
        BundleUser::observe(BundleUserObserver::class);
        LiveLessonSlot::observe(LiveLessonSlotObserver::class);
        LiveLessonSlotUser::observe(LiveLessonSlotUserObserver::class);
        WebinarUser::observe(WebinarUserObserver::class);
        Review::observe(ReviewObserver::class);
        Notification::observe(NotificationObserver::class);
        Category::observe(ForumCategoryObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
