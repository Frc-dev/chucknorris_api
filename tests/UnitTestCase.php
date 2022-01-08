<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UnitTestCase extends TestCase
{
    protected function mock(string $className): MockObject
    {
        return $this->createMock($className);
    }
}