<?php

namespace App\Repositories\Rotation;

use App\Repositories\BaseRepo;

class RotationRepo extends BaseRepo implements RotationRepoInterface
{

    public function __construct($model)
    {
        $this->model = $model;
    }
}
