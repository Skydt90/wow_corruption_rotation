<?php

namespace App\Repositories\Base\Schedule;

use App\Repositories\Base\BaseRepoInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ScheduleRepoInterface extends BaseRepoInterface
{
    public function getCurrentSchedule(): Model;
    public function getFutureSchedules(string $current_end): Collection;
}
