<?php

use App\Models\Corruption;
use App\Models\Picture;
use App\Models\Rotation;
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
        $this->corruptionService->fetchFromFile();
        
        $rotations = json_decode(file_get_contents(storage_path() .'/app/rotations.json'))->rotations;

        for($i = 1; $i <= 8; $i++) {
            $corruptions = [];

            foreach($rotations as $rota) {
                if ($rota->title === "Rotation $i") {
                    foreach($rota->corruptions as $corruption) {
                        $corruptions[] = Corruption::where('name', $corruption)->first()->id;
                    }
                    break;
                }
            }
            
            $rotation = Rotation::firstOrCreate([
                'name' => "Rotation $i",
            ]);
            $rotation->corruptions()->sync($corruptions);
        }
        
        $test = Rotation::with('corruptions')->find(8);
        $test->corruptions->each(function($corr) {
            dump($corr->name);
        });
        dd();
        /* if ($this->whaleService->get()->count() === 0) {
            $this->command->getOutput()->writeln('Fetching data from api..');

            $this->whaleService->fetchLegacyData();
            
            $this->command->getOutput()->writeln('Success!');
        } else {
            $this->command->getOutput()->writeln('Legacy data allready in DB');
        } */
    }
}
