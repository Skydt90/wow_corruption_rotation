<?php

namespace App\Repositories\Schedule;

use App\Repositories\BaseRepoInterface;

interface ScheduleRepoInterface extends BaseRepoInterface
{
    public function getCurrentSchedule();
    public function getFutureSchedules(string $current_end);
}
