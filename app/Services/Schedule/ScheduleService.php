<?php

namespace App\Services\Schedule;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

use App\Services\BaseService;
use App\Repositories\Rotation\RotationRepoInterface;
use App\Repositories\Schedule\ScheduleRepoInterface;
use App\Repositories\Corruption\CorruptionRepoInterface;

class ScheduleService extends BaseService implements ScheduleServiceInterface
{
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
        $this->repo = $scheduleRepo;
        $this->rotationRepo = $rotationRepo;
        $this->corruptionRepo = $corruptionRepo;
    }

    /**
     * Override. Fetches all records and preps them for controller to pass to view
     *
     * @return Collection
     */
    public function getForIndex(): Collection
    {
        $schedules = collect();

        $current = $this->repo->getCurrentSchedule();
        $remaining = $this->repo->getFutureSchedules($current->getEndDateRaw());

        $schedules->put('current', $current);
        $schedules->put('remaining', $remaining);

        return $schedules;
    }

    /**
     * Used for setting up schedules for the very first time
     *
     * @return void
     */
    public function firstSetup()
    {
        $id       = 1;
        $schedule = $this->createFirstSchedule();
        $start    = Carbon::createFromFormat('Y-m-d H:i:s', $schedule->getStartDateRaw());
        $max_corr = $schedule->max_corruption;

        for ($i = 1; $i <= 50; $i++) {
            $temp     = $start->toDateTimeString();
            $start    = Carbon::createFromFormat('Y-m-d H:i:s', $temp)->addMinutes(5039 + 1);
            $temp     = $start->toDateTimeString();
            $end      = Carbon::createFromFormat('Y-m-d H:i:s', $temp)->addMinutes(5039);
            $max_corr !== 125 ? $max_corr += 3 : $max_corr = 125;
            $this->repo->firstOrCreate([
                'rotation_id'    => $id,
                'max_corruption' => $max_corr,
                'start_date'     => $start->toDateTimeString(),
                'end_date'       => $end->toDateTimeString()
            ]);
            $id == 8 ? $id = 1 : $id++;
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
