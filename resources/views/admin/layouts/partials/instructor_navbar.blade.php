<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="in">
                <li class="sidebar-item selected">
                    <a href="{{ route('instructor.dashboard') }}" class="sidebar-link waves-effect waves-dark">
                        <span class="hide-menu"> @lang('backend.navbar.dashboard_menu') </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="javascript:;" class="sidebar-link has-arrow waves-effect waves-dark with-sub ">
                        <span class="hide-menu"> @lang('backend.navbar.course_catalog_menu') </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level course-catalog_menu">
                        <li class="sidebar-item">
                            <a href="{{ route('instructor.courses') }}" class="sidebar-link">
                                <span class="hide-menu"> @lang('backend.navbar.courses')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('instructor.sections') }}" class="sidebar-link">
                                <span class="hide-menu"> @lang('backend.navbar.lessons')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('instructor.units') }}" class="sidebar-link">
                                <span class="hide-menu"> @lang('backend.navbar.chapters')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('instructor.quiz') }}" class="sidebar-link">
                                <span class="hide-menu"> @lang('backend.navbar.tests')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('instructor.faqs') }}" class="sidebar-link">
                                <span class="hide-menu"> @lang('backend.navbar.faqs') </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('instructor.bundle') }}" class="sidebar-link">
                                <span class="hide-menu"> @lang('backend.navbar.bundles') </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('instructor.live_lessons') }}" class="sidebar-link">
                                <span class="hide-menu"> @lang('backend.navbar.live_lessons')</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{ route('instructor.liveLessonSlots') }}" class="sidebar-link">
                                <span class="hide-menu"> @lang('backend.navbar.live_lessons_slot')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('instructor.webinar') }}" class="sidebar-link">
                                <span class="hide-menu"> @lang('backend.navbar.webinar') </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('instructor.surveys') }}" class="sidebar-link">
                                <span class="hide-menu"> @lang('backend.navbar.surveys') </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('instructor.course_interview_questions') }}" class="sidebar-link">
                                <span class="hide-menu">Course Interview Questions</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="javascript:;" class="sidebar-link has-arrow waves-effect waves-dark with-sub">
                        <span class="hide-menu"> @lang('backend.navbar.reports')</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level ">
                        <li class="sidebar-item">
                            <a href="{{ route('instructor.sales_report') }}" class="sidebar-link">
                                <span class="hide-menu"> @lang('backend.navbar.sales_report')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('instructor.payout_report') }}" class="sidebar-link">
                                <span class="hide-menu"> @lang('backend.navbar.payout_report')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('instructor.course_report') }}" class="sidebar-link">
                                <span class="hide-menu"> @lang('backend.navbar.course_report')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('instructor.reviews') }}" class="sidebar-link">
                                <span class="hide-menu"> @lang('backend.navbar.student_reviews')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('instructor.course_survey_report') }}" class="sidebar-link">
                                <span class="hide-menu">Course Survey Report</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
