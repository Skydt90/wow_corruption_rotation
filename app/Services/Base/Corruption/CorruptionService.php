<?php

namespace App\Services\Base\Corruption;

use App\Repositories\Base\Corruption\CorruptionRepoInterface;
use App\Services\Base\BaseService;

class CorruptionService extends BaseService implements CorruptionServiceInterface
{
    
    public function __construct(CorruptionRepoInterface $repo)
    {
        $this->repo = $repo;
    }

    public function test()
    {
        dd('Hi!');
    }
}