<?php

namespace App\Services\Corruption;

use App\Services\BaseServiceInterface;

interface CorruptionServiceInterface extends BaseServiceInterface
{
    public function fetchFromFile();
}
