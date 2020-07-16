<?php

namespace App\Services\Schedule;

use App\Services\BaseServiceInterface;

interface ScheduleServiceInterface extends BaseServiceInterface
{
    public function firstSetup();
}
