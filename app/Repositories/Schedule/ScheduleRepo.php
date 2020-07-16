<?php

namespace App\Repositories\Schedule;

use App\Repositories\BaseRepo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;


class ScheduleRepo extends BaseRepo implements ScheduleRepoInterface
{

    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Fetches the current schedule
     *
     * @return Model
     */
    public function getCurrentSchedule(): Model
    {
        $now = now()->toDateTimeString();

        return $this->model->where([['start_date', '<=', $now], ['end_date', '>=', $now]])
            ->with('rotation.corruptions')->first();
    }

    /**
     * Fetches all future schedules from db
     *
     * @param string $current_end - Y-m-d H:i:s
     * @return mixed
     */
    public function getFutureSchedules(string $current_end): Collection
    {
        return $this->model->where('start_date', '>=', $current_end)->with('rotation.corruptions')->limit(7)->get();
    }
}
