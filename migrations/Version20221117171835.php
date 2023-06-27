<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221117171835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add base Event Type data into Event Types table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO event_types (title, is_active) VALUES ("info", 1);');
        $this->addSql('INSERT INTO event_types (title, is_active) VALUES ("warning", 1);');
        $this->addSql('INSERT INTO event_types (title, is_active) VALUES ("error", 1);');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE event_types');
    }
}
