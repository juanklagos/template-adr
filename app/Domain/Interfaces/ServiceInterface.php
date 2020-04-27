<?php

namespace App\Domain\Interfaces;

interface ServiceInterface
{
    public function handle($attributes = [], int $id = null);
}
