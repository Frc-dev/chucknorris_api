<?php

declare(strict_types=1);

namespace App\Tests\src\Shared\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use function Lambdish\Phunctional\first;
use function Lambdish\Phunctional\map;

class ApiEnvironmentArranger implements EnvironmentArranger
{
    private $connection;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->connection = $entityManager->getConnection();
    }

    public function arrange(): void
    {
        $this->connection->beginTransaction();
    }

    public function close(): void
    {
        $this->cleanTables();
    }

    private function cleanTables(): void
    {
        $tables = $this->connection->executeQuery('SHOW TABLES')->fetchAllAssociative();

        $sql = $this->truncateDatabaseSql($tables);

        $this->connection->executeQuery($sql);
    }

    private function truncateDatabaseSql(array $tables): string
    {
        $truncateTables = map($this->truncateTableSql(), $tables);

        return sprintf('SET FOREIGN_KEY_CHECKS = 0; %s SET FOREIGN_KEY_CHECKS = 1;', implode(' ', $truncateTables));
    }

    private function truncateTableSql(): callable
    {
        return static function (array $table): string {
            return sprintf('TRUNCATE TABLE `%s`;', first($table));
        };
    }
}