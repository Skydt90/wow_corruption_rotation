<?php

use Illuminate\Database\Seeder;
use App\Repositories\Base\Rotation\RotationRepoInterface;
use App\Repositories\Base\Corruption\CorruptionRepoInterface;

class RotationsTableSeeder extends Seeder
{
    private $rotationRepo;

    public function __construct(RotationRepoInterface $rotationRepo)
    {
        $this->rotationRepo = $rotationRepo;
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rotations = collect(json_decode(file_get_contents(storage_path() .'/app/rotations.json'))->rotations);

        for($i = 1; $i <= 8; $i++) {
            $corruptions = [];

            $rotations->each(function($rota) use($i, &$corruptions) {
                
                if ($rota->title === "Rotation $i") {
                    foreach($rota->corruptions as $corruption) {
                        $corruptions[] = $this->corruptionRepo->getWhere('name', $corruption)->id;
                    }
                    return;
                }
            });
            
            $rotation = $this->rotationRepo->firstOrCreate(['name' => "Rotation $i"]);
        }
    }
}
