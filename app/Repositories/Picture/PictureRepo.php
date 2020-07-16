<?php

namespace App\Repositories\Picture;

use App\Repositories\BaseRepo;
use Illuminate\Database\Eloquent\Model;

class PictureRepo extends BaseRepo implements PictureRepoInterface
{

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function createFromFile(object $container) : Model
    {
        return $this->model->firstOrCreate([
            'path'          => $container->picture_path,
            'corruption_id' => $container->id,
        ]);
    }
}
