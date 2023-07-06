<?php

namespace App\Repositories;

use App\Interfaces\BadgeRepositoryInterface;
use App\Models\Badge;
use App\Models\Course;

class BadgeRepository implements BadgeRepositoryInterface
{

    public function getAllBadges()
    {
        return Badge::orderBy('id', 'DESC')->get();
    }

    public function storeBadgesData($request)
    {
        $requestData = $request->all();
        $badge = Badge::create(['name' => $requestData['name']]);
        if (!empty($requestData['courses'])) {
            Course::whereIn('id', $requestData['courses'])->update(['badge_id' => $badge->id]);
        }
        return true;
    }

    public function getBadgesDetails($id)
    {
        return Badge::where('id', $id)->first();
    }

    public function updateBadgesData($request, $id)
    {
        $requestData = $request->all();
        $badges = self::getBadgesDetails($id);
        $badges->update($requestData);

        Course::where('badge_id', $id)->update(['badge_id' => null]);
        if (!empty($requestData['courses'])) {
            Course::whereIn('id', $requestData['courses'])->update(['badge_id' => $id]);
        }
        return true;
    }

    public function delete($id)
    {
        Badge::destroy($id);
        Course::where('badge_id', $id)->update(['badge_id' => null]);
        return true;
    }
}
