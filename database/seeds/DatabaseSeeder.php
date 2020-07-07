<?php

use Illuminate\Database\Seeder;
use App\Services\Base\Corruption\CorruptionServiceInterface;

class DatabaseSeeder extends Seeder
{
    private $corruptionService;

    public function __construct(CorruptionServiceInterface $corruptionService)
    {
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
    }
}
