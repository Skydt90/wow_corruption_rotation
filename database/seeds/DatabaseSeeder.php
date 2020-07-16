<?php

use Illuminate\Database\Seeder;
use App\Services\Schedule\ScheduleServiceInterface;
use App\Services\Corruption\CorruptionServiceInterface;

class DatabaseSeeder extends Seeder
{
    private $scheduleService;
    private $corruptionService;

    public function __construct(ScheduleServiceInterface $scheduleService, CorruptionServiceInterface $corruptionService)
    {
        $this->scheduleService   = $scheduleService;
        $this->corruptionService = $corruptionService;
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->getOutput()->writeln('Seeding with base data...');
        $this->call(RotationsTableSeeder::class);
        $this->corruptionService->fetchFromFile();
        $this->scheduleService->firstSetup();
    }
}
