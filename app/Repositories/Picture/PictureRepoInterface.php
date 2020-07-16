<?php

namespace App\Repositories\Picture;

use App\Repositories\BaseRepoInterface;

interface PictureRepoInterface extends BaseRepoInterface
{
    public function createFromFile(object $container);
}
