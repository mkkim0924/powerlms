<div class="table-responsive">
    <table class="table">
        <tbody>
        <tr>
            <td width="300"><b>@lang('backend.courses.label.course_price')</b></td>
            <td>{{ formatPrice($data['price']) }}</td>
        </tr>
        <tr>
            <td width="350"><b>@lang('backend.courses.label.system_revenue')({{ $data['system_revenue_percentage'] }})%</b></td>
            <td>{{ formatPrice($data['system_revenue']) }}</td>
        </tr>
        <tr>
            <td width="350"><b>@lang('backend.courses.label.system_tax')</b></td>
            <td>{{ formatPrice($data['system_revenue_tax_value']) }}</td>
        </tr>
        <tr>
            <td width="350"><b>@lang('backend.courses.label.your_tax_value')</b></td>
            <td>{{ formatPrice($data['instructor_revenue_tax_value']) }}</td>
        </tr>
        <tr>
            <td width="350"><b>@lang('backend.courses.label.your_earning_without_tax')</b></td>
            <td>{{ formatPrice($data['instructor_revenue_value']) }}</td>
        </tr>
        <tr>
            <td width="350"><b>@lang('backend.courses.label.your_earning_with_tax')</b></td>
            <td>{{ formatPrice($data['instructor_total_earning']) }}</td>
        </tr>
        </tbody>
    </table>
</div>
