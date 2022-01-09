<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220109183403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE search_results DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE search_results ADD PRIMARY KEY (result_id, search_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE search_results DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE search_results ADD PRIMARY KEY (result_id)');
    }
}
