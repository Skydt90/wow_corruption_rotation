<?php

namespace App\Repositories\Base\Corruption;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Base\BaseRepoInterface;

interface CorruptionRepoInterface extends BaseRepoInterface
{
    public function createFromFile(object $corruption) : Model;
}
