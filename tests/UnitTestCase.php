<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class UnitTestCase extends TestCase
{
    private $eventBus;

    protected function mock(string $className): MockObject
    {
        return $this->createMock($className);
    }

    /** @return MessageBusInterface|MockObject */
    protected function eventBus(): MockObject
    {
        return $this->eventBus = $this->eventBus ?: $this->mock(MessageBusInterface::class);
    }

    protected function shouldDispatchDomainEvent($event): void
    {
        $this->eventBus->expects(self::once())
            ->method('dispatch')
            ->with($event)
            ->willReturn(new Envelope($event));
    }
}