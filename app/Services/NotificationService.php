<?php
/**
 * Created by PhpStorm.
 * User: ombharti
 * Date: 1/2/2018
 * Time: 5:03 PM
 */

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public function store($instructor_id, $identifier, $params = [])
    {
        Notification::create([
            'instructor_id' => $instructor_id,
            'identifier' => $identifier,
            'params' => $params
        ]);
        return true;
    }
}
