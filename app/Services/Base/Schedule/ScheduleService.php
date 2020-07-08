<?php

namespace App\Services\Base\Schedule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Services\Base\BaseService;
use App\Repositories\Base\Rotation\RotationRepoInterface;
use App\Repositories\Base\Schedule\ScheduleRepoInterface;
use App\Repositories\Base\Corruption\CorruptionRepoInterface;

class ScheduleService extends BaseService implements ScheduleServiceInterface
{
    private $minutes;
    private $rotationRepo;
    private $corruptionRepo;

    /**
     * ScheduleService constructor.
     *
     * @param ScheduleRepoInterface $scheduleRepo
     * @param RotationRepoInterface $rotationRepo
     * @param CorruptionRepoInterface $corruptionRepo
     */
    public function __construct(ScheduleRepoInterface $scheduleRepo, RotationRepoInterface $rotationRepo, CorruptionRepoInterface $corruptionRepo)
    {
        $this->minutes = 5039;
        $this->repo = $scheduleRepo;
        $this->rotationRepo = $rotationRepo;
        $this->corruptionRepo = $corruptionRepo;
    }

    /**
     * Used for setting up schedules for the very first time
     *
     * @return void
     */
    public function firstSetup()
    {
        if ($this->repo->get()->isEmpty()) {
            $schedule = $this->createFirstSchedule();
        } else {
            $schedule = $this->repo->getOrderBy('end_date', 'desc');
        }

        $start    = $schedule->getStartDateClean();
        $max_corr = $schedule->max_corruption;

        for ($i = 1; $i <= 6; $i++) {
            $start    = Carbon::createFromFormat('Y-m-d H:i:s', $start, 'Europe/Copenhagen')->setTimezone('UTC')->addMinutes($this->minutes + 1);
            $end      = Carbon::createFromFormat('Y-m-d H:i:s', $start, 'Europe/Copenhagen')->setTimezone('UTC')->addMinutes($this->minutes);
            $max_corr += 3;
            $this->repo->firstOrCreate([
                'rotation_id'    => $i,
                'max_corruption' => $max_corr,
                'start_date'     => $start->toDateTimeString(),
                'end_date'       => $end->toDateTimeString()
            ]);
        }
    }

    /**
     * Used for creating the first schedule, before any exist in db
     *
     * @return Model
     */
    private function createFirstSchedule() : Model
    {
        $this->repo->firstOrCreate([
            'rotation_id' => 7,
            'max_corruption' => 98,
            'start_date' => Carbon::createFromFormat('d/m/Y H:i:s', '8/7/2020 09:00:00', 'Europe/Copenhagen')->setTimezone('UTC')->toDateTimeString(),
            'end_date' => Carbon::createFromFormat('d/m/Y H:i:s', '11/7/2020 20:59:00', 'Europe/Copenhagen')->setTimezone('UTC')->toDateTimeString()
        ]);

        return $this->repo->firstOrCreate([
            'rotation_id' => 8,
            'max_corruption' => 101,
            'start_date' => Carbon::createFromFormat('d/m/Y H:i:s', '11/7/2020 21:00:00', 'Europe/Copenhagen')->setTimezone('UTC')->toDateTimeString(),
            'end_date' => Carbon::createFromFormat('d/m/Y H:i:s', '15/7/2020 08:59:00', 'Europe/Copenhagen')->setTimezone('UTC')->toDateTimeString()
        ]);
    }


}
