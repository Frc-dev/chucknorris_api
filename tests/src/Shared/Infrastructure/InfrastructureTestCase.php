<?php

declare(strict_types=1);

namespace App\Tests\src\Shared\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

class InfrastructureTestCase extends KernelTestCase
{
    private $httpClient;

    protected function setUp(): void
    {
        self::bootKernel(['environment' => 'test']);

        parent::setUp();

        $arranger = new ApiEnvironmentArranger(
            $this->service(EntityManagerInterface::class)
        );

        $arranger->arrange();
    }

    protected function tearDown(): void
    {
        $arranger = new ApiEnvironmentArranger(
            $this->service(EntityManagerInterface::class)
        );

        $arranger->close();
        $this->clearUnitOfWork();

        parent::tearDown();
    }

    protected function clearUnitOfWork(): void
    {
        $this->service(EntityManagerInterface::class)->clear();
    }

    protected function flush(): void
    {
        $this->service(EntityManagerInterface::class)->flush();
        $this->clearUnitOfWork();
    }

    /** @return HttpClientInterface|MockObject */
    public function httpClient()
    {
        return $this->httpClient = $this->httpClient ?? $this->createMock(HttpClientInterface::class);
    }

    /** @return mixed */
    protected function service($id)
    {
        return self::$container->get($id);
    }

    /**
     * @throws Throwable
     */
    protected function eventually(callable $fn, $totalRetries = 3, $timeToWaitOnErrorInSeconds = 1): void
    {
        try {
            $fn();
        } catch (Throwable $error) {
            if ($totalRetries === 0) {
                throw $error;
            }

            sleep($timeToWaitOnErrorInSeconds);

            $this->eventually($fn, --$totalRetries, $timeToWaitOnErrorInSeconds);
        }
    }
}

