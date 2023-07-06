<?php

use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use JetBrains\PhpStorm\Pure;

function formatDate($date, $format = 'M d, Y h:i A'): ?string
{
    if ($date != null) {
        return Carbon\Carbon::parse($date)->format($format);
    }
    return null;
}

function getTotalCourseHours($time): string
{
    $array = explode(':', $time);
    if (isset($array[0]) && $array[0] == 00) {
        return ($array[1] ?? '00') . ' ' . __('frontend.course_card.minutes_text');
    }
    return ($array[0] ?? '00') . ' ' . __('frontend.course_card.hour_text');
}

function getMinutesToHour($minutes): string
{
    if ($minutes <= 0) {
        return '00';
    }
    $hours = floor($minutes / 60);
    $minutes = ($minutes >= 60) ? ($minutes - 60) : $minutes;
    return ($hours > 9 ? $hours : '0' . $hours) . ':' . ($minutes > 9 ? $minutes : '0' . $minutes);
}

function getCurrentAdmin(): ?\Illuminate\Contracts\Auth\Authenticatable
{
    if (auth()->guard('admins')->check()) {
        return auth()->guard('admins')->user();
    }
    return null;
}

function getForumUserName(): string
{
    return auth()->guard('admins')->user()->name ?? (auth()->user()->name ?? "Forum User");
}

function getCurrentUser(): ?\Illuminate\Contracts\Auth\Authenticatable
{
    if (auth()->check()) {
        return auth()->user();
    }
    return null;
}

function uploadFile($file, $path, $exist_file = null, $resizeArr = []): string
{
    $uploadPath = storage_path('app/public/' . $path . '/');
    if (isset($exist_file) && (strpos($exist_file, 'default-') === false)) {
        $imagePath = $uploadPath . $exist_file;
        @unlink($imagePath);
    }
    $extension = $file->getClientOriginalExtension();
    $fileName = rand(11111, 99999) . time() . '.' . $extension;
    if (!file_exists($uploadPath)) {
        mkdir($uploadPath, 666, true);
    }
    if (!empty($resizeArr)) {
        $img = Image::make($file->path());
        $img->resize($resizeArr['width'], $resizeArr['height'], function ($constraint) {
            $constraint->aspectRatio();
        })->save($uploadPath . $fileName);
    } else {
        $file->move($uploadPath, $fileName);
    }
    return $fileName;
}

function unlinkFile($file_name, $path): bool
{
    $uploadPath = storage_path('app/public/' . $path . '/');
    $imagePath = $uploadPath . $file_name;
    @unlink($imagePath);
    return true;
}

function checkSlugExist($courseId, $slug): bool
{
    $curriculumExist = \App\Models\Curriculum::where(['course_id' => $courseId, 'curriculum_slug' => $slug])->first();
    return isset($curriculumExist);
}

function getFileUrl($file_name, $path)
{
    return url('storage/' . $path . '/' . $file_name);
}

function getCurrency(): array
{
    $currency = DB::table('currencies')->select('short_code', 'symbol', 'name', 'country')->where('short_code', config('app.currency'))->first();
    return is_null($currency) ? [] : (array)$currency;
}

function formatPrice($value): string
{
    $value = number_format($value, 2, '.', ',');
    if (config('currency_position') == 'left') {
        return config('currency_symbol') . $value;
    } elseif (config('currency_position') == 'right') {
        return $value . config('currency_symbol');
    } elseif (config('currency_position') == 'left-space') {
        return config('currency_symbol') . ' ' . $value;
    } elseif (config('currency_position') == 'right-space') {
        return $value . ' ' . config('currency_symbol');
    } else {
        return config('currency_symbol') . $value;
    }
}

function getStarRatingHtml($rating = 5): string
{
    $retStr = '';
    $numberArr = [floor($rating), ($rating - floor($rating))]; //numberBreakdown
    $filledStars = $numberArr[0] ?? 5;
    $halfStars = ($numberArr[1] != 0);
    $blankStars = ($halfStars) ? (5 - ($numberArr[0] ?? 5) - 1) : (5 - ($numberArr[0] ?? 5));
    for ($i = 1; $i <= $filledStars; $i++) {
        $retStr .= htmlentities("<i class='fas fa-star'></i>", ENT_NOQUOTES);
    }
    if ($halfStars) {
        $retStr .= htmlentities("<i class='fas fa-star-half-alt'></i>", ENT_NOQUOTES);
    }
    for ($i = 1; $i <= $blankStars; $i++) {
        $retStr .= htmlentities("<i class='far fa-star'></i>", ENT_NOQUOTES);
    }
    return html_entity_decode($retStr);
}

function getCourseWiseRatingsArray($course_id): array
{
    $ratings = [];
    $total_rating_percent = 100;
    $totalRatings = 0;
    $ratingData = DB::select("SELECT CEIL(rating) as rating, COUNT(rating) AS 'rating_count'
                FROM reviews WHERE course_id = $course_id AND CEIL(rating) > 0
                GROUP BY CEIL(rating)");
    $ratingData = array_reverse($ratingData);
    foreach ($ratingData as $rating) {
        $totalRatings += $rating->rating_count;
    }
    foreach ($ratingData as $rating) {
        $rating->percent = round(($rating->rating_count * 100) / $totalRatings);
        $rating->percent = ($total_rating_percent >= $rating->percent) ? $rating->percent : ($rating->percent - ($rating->percent - $total_rating_percent));
        $ratings[$rating->rating] = (array)$rating;
        $total_rating_percent = $total_rating_percent - $rating->percent;
    }
    $total_percent = 100;
    $returnData = [];
    for ($i = 5; $i > 0; $i--) {
        $returnData[$i] = $ratings[$i] ?? ['rating' => $i, 'rating_count' => 0, 'percent' => 0];
        if (count($ratingData) > 0) {
            $total_percent = $total_percent - $returnData[$i]['percent'];
            if (isset($returnData[$i]) && ($i == 1) && ($total_percent > 0)) {
                $returnData[$i]['percent'] = $returnData[$i]['percent'] + $total_percent;
            }
        }
    }
    return $returnData;
}

function formatCurriculumTime($unit_time): ?string
{
    $unit_time_arr = explode(":", $unit_time);

    $hours = (isset($unit_time_arr[0]) && ($unit_time_arr[0] != "00")) ? $unit_time_arr[0] : null;
    $mins = (isset($unit_time_arr[1]) && ($unit_time_arr[1] != "00")) ? $unit_time_arr[1] : null;
    $seconds = (isset($unit_time_arr[2]) && ($unit_time_arr[2] != "00")) ? $unit_time_arr[2] : null;

    $time_string = null;
    if (!is_null($hours)) {
        $time_string .= $hours . "h ";
    }
    if (!is_null($mins)) {
        $time_string .= ltrim($mins, '0') . "m ";
    }
    if (!is_null($seconds)) {
        $time_string .= ltrim($seconds, '0') . "s";
    }
    return $time_string;
}

function calculateEarnings($price, $system_revenue_percentage): array
{
    $data['price'] = number_format($price, 2, '.', '');
    $data['system_revenue_percentage'] = $system_revenue_percentage ?? (config('system_revenue_percentage') ?? 0);
    $data['tax_value_percentage'] = config('tax_value_percentage') ?? 0;

    $data['total_tax'] = number_format(max(($data['price'] * $data['tax_value_percentage']) / 100, 0), 2, '.', '');
    $data['system_revenue'] = number_format(max(($data['price'] * $data['system_revenue_percentage']) / 100, 0), 2, '.', '');
    $data['system_revenue_tax_value'] = number_format(max(($data['tax_value_percentage'] * $data['system_revenue']) / 100, 0), 2, '.', '');
    $data['instructor_total_earning'] = number_format(max($data['price'] - $data['system_revenue'] - $data['system_revenue_tax_value'], 0), 2, '.', '');
    $data['instructor_revenue_tax_value'] = number_format(max(($data['tax_value_percentage'] * $data['instructor_total_earning']) / 100, 0), 2, '.', '');
    $data['instructor_revenue_value'] = number_format(max($data['instructor_total_earning'] - $data['instructor_revenue_tax_value'], 0), 2, '.', '');
    return $data;
}

function getMonthList(): array
{
    return [
        1 => __("global.month.january"),
        2 => __("global.month.february"),
        3 => __("global.month.march"),
        4 => __("global.month.april"),
        5 => __("global.month.may"),
        6 => __("global.month.june"),
        7 => __("global.month.july"),
        8 => __("global.month.august"),
        9 => __("global.month.september"),
        10 => __("global.month.october"),
        11 => __("global.month.november"),
        12 => __("global.month.december"),
    ];
}

function randomDateInRange(DateTime $start, DateTime $end)
{
    $randomTimestamp = mt_rand($start->getTimestamp(), $end->getTimestamp());
    $randomDate = new DateTime();
    $randomDate->setTimestamp($randomTimestamp);
    return $randomDate;
}
