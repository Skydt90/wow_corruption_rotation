<?php

namespace App\Services\Base\Schedule;

use App\Services\Base\BaseServiceInterface;

interface ScheduleServiceInterface extends BaseServiceInterface
{
    public function firstSetup();
}
