<?php

namespace App\Repositories\Base\Picture;

use App\Repositories\Base\BaseRepoInterface;
use Illuminate\Database\Eloquent\Model;

interface PictureRepoInterface extends BaseRepoInterface
{
    public function createFromFile(object $container) : Model;
}