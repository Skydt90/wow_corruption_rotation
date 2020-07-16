<?php

namespace App\Repositories\Corruption;

use App\Repositories\BaseRepoInterface;

interface CorruptionRepoInterface extends BaseRepoInterface
{
    public function createFromFile(object $corruption);
}
