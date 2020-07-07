<?php

namespace App\Repositories\Base\Rotation;

use App\Repositories\Base\BaseRepo;
use Illuminate\Database\Eloquent\Model;

class RotationRepo extends BaseRepo implements RotationRepoInterface
{

    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * This will handle pivot attachments on the rotation model
     *
     * @param array $values
     * @param Model $rotation
     * @return void
     */
    public function syncCorruption(array $values, Model $rotation)
    {
        $rotation->corruptions()->sync($values);
    }
}