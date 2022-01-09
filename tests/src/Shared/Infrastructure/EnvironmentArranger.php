<?php

declare(strict_types = 1);

namespace App\Tests\src\Shared\Infrastructure;

interface EnvironmentArranger
{
    public function arrange(): void;

    public function close(): void;
}