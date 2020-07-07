<?php

namespace App\Repositories\Base\Rotation;

use App\Repositories\Base\BaseRepo;

class RotationRepo extends BaseRepo implements RotationRepoInterface
{

    public function __construct($model)
    {
        $this->model = $model;
    }
}
