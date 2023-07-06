<div class="form-group">
    <input type="checkbox" name="is_free" id="is_free"
           class="js-input-switch" @if (isset($course) && $course->is_free == 1) checked @endif>
    <label class="ml-2" for="is_free">@lang('backend.courses.label.check_if_free')</label>
</div>
<div id="coursePriceDiv" @if (isset($course) && $course->is_free == 1) style="display: none;" @endif>
    <div class="form-group">
        <label>@lang('backend.courses.label.price')</label>
        <span class="text-danger">*</span>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text px-2">{{ config('currency_symbol') }}</span>
            </div>
            {!! Form::number('price', $formMode == 'edit' ? $course->price : old('price'), [
                'id' => 'price',
                'class' => 'form-control',
                'min' => '0',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.courses.label.price'))]),
            ]) !!}
            <div class="input-group-append">
                <a href="javascript:;" id="calculateEarning" class="btn btn-info py-0 d-flex align-items-center" type="button">@lang('backend.courses.button.calculate_earning')</a>
            </div>
        </div>
    </div>
    <div class="form-group">
        <input type="checkbox" name="discount_flag" id="discount_flag"
               class="js-input-switch" @if (isset($course) && $course->discount_flag == 1) checked @endif>
        <label class="ml-2" for="discount_flag">@lang('backend.courses.label.if_discount')</label>
    </div>
    <div class="form-group" id="discountedPriceInput"
         @if ((isset($course) && $course->discount_flag == 0) || !isset($course)) style="display: none;" @endif>
        <label>@lang('backend.courses.label.discounted_price')</label>
        <span class="text-danger">*</span>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text px-2">{{ config('currency_symbol') }}</span>
            </div>
            {!! Form::number('discounted_price', $formMode == 'edit' ? $course->discounted_price : old('discounted_price'), [
                'class' => 'form-control',
                'id' => 'discounted_price',
                'min' => '0',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.courses.label.discounted_price'))]),
                'data-validation-depends-on' => 'discount_flag',
            ]) !!}
        </div>
    </div>
    <div class="form-group">
        <input type="checkbox" name="subscription_flag" id="subscription_flag"
               class="js-input-switch" @if (isset($course) && $course->subscription_flag == 1) checked @endif @if(config('services.stripe.active') == 0) disabled @endif>
        <label class="ml-2" for="subscription_flag">@lang('backend.courses.label.check_if_this_course_has_subscription') <i class="fa fa-info-circle" data-toggle="tooltip" data-original-title="{{ __('backend.courses.label.subscription_checkbox_info_text') }}"></i> </label>
    </div>
    <div class="row" id="subscriptionInputs"
         @if ((isset($course) && $course->subscription_flag == 0) || !isset($course)) style="display: none;" @endif>
        <div class="col-sm-6">
            <div class="form-group">
                <label>@lang('backend.courses.label.subscription_price')</label>
                <span class="text-danger">*</span>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">{{ config('currency_symbol') }}</span>
                    </div>
                    {!! Form::number('subscription_price', $course->subscription_price ?? old('subscription_price'), [
                        'class' => 'form-control',
                        'id' => 'subscription_price',
                        'min' => '1',
                        'data-validation' => 'required',
                        'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.courses.label.subscription_price'))]),
                        'data-validation-depends-on' => 'subscription_flag',
                    ]) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>@lang('backend.courses.label.subscription_interval')</label>
                <span class="text-danger">*</span>
                <div class="input-group">
                    {!! Form::number('subscription_interval_count', $course->subscription_interval_count ?? old('subscription_interval_count'), [
                        'class' => 'form-control',
                        'id' => 'subscription_interval_count',
                        'min' => '1',
                        'data-validation' => 'required',
                        'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.courses.label.subscription_interval'))]),
                        'data-validation-depends-on' => 'subscription_interval_count',
                    ]) !!}
                    <div class="input-group-append">
                        {!! Form::select('subscription_interval', ['day' => 'Day', 'week' => 'Week', 'month' => 'Month', 'year' => 'Year'], $course->subscription_interval ?? old('subscription_interval'), [
                        'id' => 'subscription_interval',
                        'data-validation-depends-on' => 'subscription_flag',
                    ]) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>@lang('backend.courses.label.subscription_installment_count')</label>
                <span class="text-danger">*</span>
                {!! Form::number('subscription_installment_count', $course->subscription_installment_count ?? old('subscription_installment_count'), [
                    'class' => 'form-control',
                    'id' => 'subscription_installment_count',
                    'min' => '1',
                    'data-validation' => 'required',
                    'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.courses.label.subscription_installment_count'))]),
                    'data-validation-depends-on' => 'subscription_flag',
                ]) !!}
            </div>
        </div>
    </div>
    <div id="priceCalculationDiv"></div>
</div>
