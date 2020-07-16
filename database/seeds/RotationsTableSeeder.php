<?php

use Illuminate\Database\Seeder;
use App\Repositories\Base\Rotation\RotationRepoInterface;

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
        for ($i = 1; $i <= 8; $i++) {
            $this->rotationRepo->firstOrCreate(['name' => "Rotation $i"]);
        }
    }
}
