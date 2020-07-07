<?php

namespace App\Repositories\Base\Picture;

use App\Repositories\Base\BaseRepo;
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