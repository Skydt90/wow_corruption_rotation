<?php

namespace App\Repositories\Base\Schedule;

use App\Repositories\Base\BaseRepo;

class ScheduleRepo extends BaseRepo implements ScheduleRepoInterface
{

    public function __construct($model)
    {
        $this->model = $model;
    }
}